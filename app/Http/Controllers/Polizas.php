<?php

namespace App\Http\Controllers;

use App\Models\Poliza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class Polizas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polizas = Poliza::whereUserId(auth()->user()->id)->paginate(20);

        return view('polizas.index', compact('polizas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('polizas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'n_poliza' => 'required|numeric',
        ]);
        $data['user_id'] = auth()->user()->id;

        $poliza = Poliza::create($data);

        return redirect(route('polizas.show', $poliza->id))->banner('Se creo la poliza');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\poliza  $poliza
     * @return \Illuminate\Http\Response
     */
    public function show(poliza $poliza)
    {
        if ($poliza->user_id != auth()->user()->id) {
            abort(403);
        }
        return view('polizas.show', compact('poliza'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\poliza  $poliza
     * @return \Illuminate\Http\Response
     */
    public function edit(poliza $poliza)
    {
        if ($poliza->user_id != auth()->user()->id) {
            abort(403);
        }
        return view('polizas.edit', compact('poliza'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\poliza  $poliza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, poliza $poliza)
    {
        if ($poliza->user_id != auth()->user()->id) {
            abort(403);
        }

        return redirect(route('polizas.show', $poliza->id))->banner('Se actualizo la poliza');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\poliza  $poliza
     * @return \Illuminate\Http\Response
     */
    public function destroy(poliza $poliza)
    {
        if ($poliza->user_id != auth()->user()->id) {
            abort(403);
        }

        $poliza->delete();

        return redirect(route('polizas.index'))->banner('Se elimino la poliza');
    }

    public function zipDownload(Poliza $poliza)
    {
        if ($poliza->user_id != auth()->user()->id) {
            abort(403);
        }

        $zip_file = 'polizas_zip/Poliza_' . $poliza->n_poliza . '.zip';
        if (Storage::exists($zip_file)) {
            Storage::delete($zip_file);
        }

        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/' . $zip_file),  ZipArchive::CREATE)) {
            $files = $poliza->soportes->pluck('name', 'path');
            if ($poliza->path) {
                $files[$poliza->path] = 'poliza/' . $poliza->name;
            }

            foreach ($files as $path => $name) {
                $zip->addFile(storage_path('app/' . $path), $name);
            }
            $zip->close();
        } else {
            return redirect(route('polizas.show', $poliza->id))->dangerBanner('Algo paso y no se pudo crear el archivo');
        }

        return Storage::download($zip_file);
    }
}
