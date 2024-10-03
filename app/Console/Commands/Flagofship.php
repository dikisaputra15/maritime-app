<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class Flagofship extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:runflagofship';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'flagofship added';

    /**
     * Execute the console command.
     */

     public function __construct()
     {
         parent::__construct();
     }

    public function handle()
    {
        $response = Http::get('https://maritime.code69.my.id/flag');

        if ($response->successful()) {
            $this->info('Category accessed successfully.');
        } else {
            $this->error('Failed to access category.');
        }
    }
}
