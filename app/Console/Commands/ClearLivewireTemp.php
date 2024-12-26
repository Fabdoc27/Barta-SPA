<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLivewireTemp extends Command
{
    protected $signature = 'clear-livewire-temp';

    protected $description = 'Clear all temporary Livewire files and folders';

    public function handle()
    {
        $path = storage_path('app/private/livewire-tmp');

        if (! File::exists($path)) {
            $this->error('No Livewire temporary files found at: '.$path);

            return;
        }

        $this->info('Livewire temporary files cleared successfully.');
    }
}
