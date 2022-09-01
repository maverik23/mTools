<?php

namespace App\Http\Controllers;

use App\Models\Poliza;
use App\Models\Soporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class Soportes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('soportes.index', compact('poliza'));
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
        return redirect(route('polizas.index'))->banner('Se agrego el soporte');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\soporte  $soporte
     * @return \Illuminate\Http\Response
     */
    public function show(Soporte $soporte)
    {
        if ($soporte->user_id != auth()->user()->id) {
            abort(403);
        }
        return view('soportes.show', compact('soporte'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\soporte  $soporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Soporte $soporte)
    {
        if ($soporte->user_id != auth()->user()->id) {
            abort(403);
        }
        return view('soportes.edit', compact('soporte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\soporte  $soporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soporte $soporte)
    {
        if ($soporte->user_id != auth()->user()->id) {
            abort(403);
        }

        return redirect(route('polizas.show', $soporte->poliza->id))->banner('Se actualizo el soporte');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\soporte  $soporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soporte $soporte)
    {
        if ($soporte->user_id != auth()->user()->id) {
            abort(403);
        }
        $id = $soporte->poliza->id;
        $soporte->delete();

        return redirect(route('polizas.show', $id))->banner('Se elimino el soporte');
    }

    public function zipDownload(Poliza $poliza)
    {
        if ($poliza->user_id != auth()->user()->id) {
            abort(403);
        }

        $zip_file = 'soportes_zip/Soportes_' . $poliza->n_poliza . '.zip';
        if (Storage::exists($zip_file)) {
            Storage::delete($zip_file);
        }

        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/' . $zip_file),  ZipArchive::CREATE)) {
            $files = $poliza->soportes->pluck('name', 'path');
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
