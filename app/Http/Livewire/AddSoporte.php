<?php

namespace App\Http\Livewire;

use App\Models\Poliza;
use App\Models\Soporte;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddSoporte extends Component
{
    use WithFileUploads;

    public $poliza;
    public $estacion;
    public $cuenta;
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
            $this->poliza->n_poliza . '_' .
            ($this->estacion ? $this->estacion . '_' : '') .
            ($this->cuenta ? $this->cuenta . '_' : '') .
            now()->format('Ym');
    }

    public function submit()
    {
        $this->validate([
            'file' => 'required|max:99',
            'file.*' => 'file|max:4096',
            'name' => 'max:255',
        ]);

        $existeNombre = Soporte::where('user_id', auth()->user()->id)->where('name', $this->name)->first();
        if ($existeNombre) {
            $this->addError('name', 'El nombre de documento ya existe.');
        } else {

            if (count($this->file) > 1) {
                $filesCount = 1;
                $lastName = null;

                foreach ($this->file as $file) {
                    $path = $file->store('soportes');
                    $ext = pathinfo(storage_path('app/' . $path), PATHINFO_EXTENSION);
                    $name = pathinfo(storage_path('app/' . $path), PATHINFO_FILENAME);

                    if ($lastName == substr_replace($file->getClientOriginalName(), '', -3)) {
                        $name = $this->name . '_' . $filesCount - 1 . '.' . $ext;
                    } else {
                        $name = $this->name . '_' . $filesCount . '.' . $ext;
                    }

                    $data['poliza_id'] = $this->poliza->id;
                    $data['user_id'] = auth()->user()->id;
                    $data['name'] = $name;
                    $data['path'] = $path;
                    $data['file'] = $name . '.' . $ext;

                    Soporte::create($data);

                    $filesCount++;
                    $lastName = substr_replace($file->getClientOriginalName(), '', -3);
                }
            } else {
                foreach ($this->file as $file) {
                    $path = $file->store('soportes');
                    $ext = pathinfo(storage_path('app/' . $path), PATHINFO_EXTENSION);
                    $name = pathinfo(storage_path('app/' . $path), PATHINFO_FILENAME);

                    $data['poliza_id'] = $this->poliza->id;
                    $data['user_id'] = auth()->user()->id;
                    $data['name'] = $this->name . '.' . $ext;
                    $data['path'] = $path;
                    $data['file'] = $name . '.' . $ext;

                    Soporte::create($data);
                }
            }

            return redirect()->to(route('polizas.show', $this->poliza->id));
        }
    }

    public function render()
    {
        return view('livewire.add-soporte');
    }
}
