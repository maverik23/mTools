<?php

namespace App\Console\Commands;

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
