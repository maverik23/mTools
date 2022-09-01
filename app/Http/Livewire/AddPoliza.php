<?php

namespace App\Http\Livewire;

use App\Models\Poliza;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddPoliza extends Component
{

    use WithFileUploads;

    public $poliza;
    public $name;
    public $file;

    public function mount(Poliza $poliza)
    {
        $this->poliza = $poliza;
        $this->name();
    }

    public function name()
    {
        $this->name = 'MAM_' .
            $this->poliza->n_poliza .
            '_ALL_GR_' .
            now()->format('Ym');
    }

    public function submit()
    {
        $this->validate([
            'file' => 'file|max:4096', // 4MB Max
        ]);

        $path = $this->file->store('polizas');
        $ext = pathinfo(storage_path('app/' . $path), PATHINFO_EXTENSION);
        $name = pathinfo(storage_path('app/' . $path), PATHINFO_FILENAME);

        $this->poliza->name = $this->name . '.' . $ext;
        $this->poliza->path = $path;
        $this->poliza->file = $name . '.' . $ext;
        $this->poliza->save();

        return redirect()->to(route('polizas.show', $this->poliza->id));
    }

    public function render()
    {
        return view('livewire.add-poliza');
    }
}
