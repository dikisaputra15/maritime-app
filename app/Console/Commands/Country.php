<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class Country extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:runcountry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'country added';

    /**
     * Execute the console command.
     */

     public function __construct()
     {
         parent::__construct();
     }

    public function handle()
    {
        $response = Http::get('https://maritime.code69.my.id/country');

        if ($response->successful()) {
            $this->info('Category accessed successfully.');
        } else {
            $this->error('Failed to access category.');
        }
    }
}