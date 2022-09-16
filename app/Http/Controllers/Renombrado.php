<?php

namespace App\Http\Controllers;

use App\Models\Poliza;
use App\Models\Soporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class Renombrado extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('renombrados.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $poliza = Poliza::findOrFail($request->poliza);
        if ($poliza->user_id != auth()->user()->id) {
            abort(403);
        }
        return view('soportes.create', compact('poliza'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'docs' => 'required|max:99',
            'docs.*' => 'max:4096',
            'name' => 'max:255',
        ]);

        $paths = [];
        foreach ($request->file('docs') as $file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = str_replace('.' . $extension, '', $filename);

            $name = str_replace('$nombre$', $filename, $request->name);

            $path = $file->storeAs('renombrados', $name . '.' . $extension);
            array_push($paths, [$path => $name . '.' . $extension]);
        }

        return $this->zipDownload($paths);
    }

    public function zipDownload(array $files)
    {
        $zip_file = 'renombrados_zip/Renombrados_' . now()->unix() . '.zip';
        if (Storage::exists($zip_file)) {
            Storage::delete($zip_file);
        }

        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/' . $zip_file),  ZipArchive::CREATE)) {
            foreach ($files as $data) {
                $zip->addFile(storage_path('app/' . key($data)), $data[key(($data))]);
            }
            $zip->close();
        }

        if (Storage::exists($zip_file)) {
            return Storage::download($zip_file);
        }
    }
}
