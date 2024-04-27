<?php

namespace App\Livewire;

use ZipArchive;
use Livewire\Component;
use setasign\Fpdi\Fpdi;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class UploadFirmas extends Component
{
    use WithFileUploads;

    #[Validate(['files.*' => 'mimetypes:application/pdf|mimes:pdf|max:2048'])]
    public $files = [];

    public function rules()
    {
        return [
            'files.*' => ['mimetypes:application/pdf', 'mimes:pdf', 'max:2048']
        ];
    }

    public function render()
    {
        return view('livewire.upload-firmas');
    }

    public function save()
    {
        $validated = $this->validate();
        $files = [];

        foreach ($this->files as $file) {
            $files[] = $this->signPDF($file);
        }

        $this->files = [];
        $path = $this->makeZip($files);

        return redirect()->route('firmas.download', ['path' => $path]);
    }

    private function signPDF($file)
    {
        $storedData = '';

        $path = $file->store(path: 'firmas-pdf');
        $storedData = [$path => $file->getClientOriginalName()];

        $pdf = new FPDI('l');
        $pagecount = $pdf->setSourceFile(storage_path('app/' . $path));

        for ($i = 1; $i <= $pagecount; $i++) {
            $tpl = $pdf->importPage($i);
            $specs = $pdf->getTemplateSize($tpl);
            $pdf->AddPage($specs['orientation']);
            $pdf->useTemplate($tpl);
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize('20');
            $pdf->SetXY(($pdf->GetPageWidth() - 30) / 2, ($pdf->GetPageHeight() - 10) * 0.92);

            if ($i == 1) {
                $pdf->Cell(30, 5, auth()->user()->name, 0, 0, 'C');
            }
        }

        $pdf->Output(storage_path('app/' . $path), 'F');

        return $storedData;
    }

    private function makeZip(array $files)
    {
        $zip_name = now()->unix() . '.zip';
        $zip_file = 'firmas_zip/' . $zip_name;
        if (Storage::exists($zip_file)) {
            Storage::delete('app/' . $zip_file);
        }

        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/' . $zip_file),  ZipArchive::CREATE)) {
            foreach ($files as $file) {
                $zip->addFile(storage_path('app/' . key($file)), $file[key($file)]);
            }

            $zip->close();
        } else {
            return redirect()->route('firmas.index');
        }

        return $zip_file;
    }
}
