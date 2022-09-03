<?php

namespace App\Console\Commands;

use App\Models\Poliza;
use App\Models\Soporte;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GarbageCollector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpiar los archivos temporales y de descargas';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $soportes = Soporte::where('created_at', '<=', now()->subMonth())->get();
        foreach ($soportes as $poliza) {
            $poliza->delete();
        }
        $this->info('se eliminaron ' . $soportes->count() . ' soportes');

        $polizas = Poliza::where('created_at', '<=', now()->subMonth())->get();
        foreach ($polizas as $poliza) {
            $poliza->delete();
        }
        $this->info('se eliminaron ' . $polizas->count() . ' polizas');

        $folders = [
            'firmas_zip',
            'firmas-tmp',
            'livewire-tmp',
        ];

        foreach ($folders as $folder) {
            $files =   Storage::allFiles($folder);
            Storage::delete($files);
        }
    }
}
