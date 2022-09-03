<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use ZipArchive;

class FirmarPDF extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('firmas-PDF.create'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('firmar.create');
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
            'files' => 'required',
            'files.*' => 'mimes:pdf|max:2048'
        ]);

        $files = [];
        foreach ($data['files'] as $file) {
            $path = $file->store('firmas-tmp');
            array_push($files, [$path => $file->getClientOriginalName()]);
            $pdf = new FPDI('l');
            $pagecount = $pdf->setSourceFile(storage_path('app/' . $path));

            if ($request->has('primera_pagina')) {
                for ($i = 1; $i <= $pagecount; $i++) {
                    $tpl = $pdf->importPage($i);
                    $specs = $pdf->getTemplateSize($tpl);
                    $pdf->AddPage($specs['orientation']);
                    $pdf->useTemplate($tpl);
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize('20');
                    $pdf->SetXY(($pdf->GetPageWidth() - 30) / 2, ($pdf->GetPageHeight() - 10) * 0.92);

                    if ($i == 1) {
                        if ($request->has('imagen')) {
                            if (auth()->user()->profile_photo_path) {
                                $pdf->Image(public_path('storage/' . auth()->user()->profile_photo_path), ($pdf->GetPageWidth() - 30) / 2, ($pdf->GetPageHeight() - 10) * 0.92, 20);
                            }
                        }
                        if ($request->has('nombre')) {
                            $pdf->Cell(30, 5, auth()->user()->name, 0, 0, 'C');
                        }
                    }
                }
            } else {
                for ($i = 1; $i <= $pagecount; $i++) {
                    $tpl = $pdf->importPage($i);
                    $specs = $pdf->getTemplateSize($tpl);
                    $pdf->AddPage($specs['orientation']);
                    $pdf->useTemplate($tpl);
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize('20');
                    $pdf->SetXY(($pdf->GetPageWidth() - 30) / 2, ($pdf->GetPageHeight() - 10) * 0.92);

                    if ($request->has('imagen')) {
                        if (auth()->user()->profile_photo_path) {
                            $pdf->Image(public_path('storage/' . auth()->user()->profile_photo_path), ($pdf->GetPageWidth() - 30) / 2, ($pdf->GetPageHeight() - 10) * 0.92, 20);
                        }
                    }
                    if ($request->has('nombre')) {
                        $pdf->Cell(30, 5, auth()->user()->name, 0, 0, 'C');
                    }
                }
            }
            $pdf->Output(storage_path('app/' . $path), 'F');
        }

        return $this->zipDownload($files);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function zipDownload(array $files)
    {
        $zip_file = 'firmas_zip/Firmas_' . str_replace('-', ' ', auth()->user()->name) . '_' . count($files) . 'archivos.zip';
        if (Storage::exists($zip_file)) {
            Storage::delete($zip_file);
        }

        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/' . $zip_file),  ZipArchive::CREATE)) {
            foreach ($files as $file) {
                $zip->addFile(storage_path('app/' . key($file)), $file[key($file)]);
            }
            $zip->close();
        } else {
            return redirect(route('firmas-PDF.create'))->dangerBanner('Algo paso y no se pudo crear el archivo');
        }
        return Storage::download($zip_file);
    }
}
