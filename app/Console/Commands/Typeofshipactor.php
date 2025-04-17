<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class Typeofshipactor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:runtypeofshipactor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'typeofshipactor added';

    /**
     * Execute the console command.
     */

     public function __construct()
     {
         parent::__construct();
     }

    public function handle()
    {
        $response = Http::get('https://maritime.code69.my.id/typeofshipactor');

        if ($response->successful()) {
            $this->info('typeofshipactor accessed successfully.');
        } else {
            $this->error('Failed to access typeofsihpactor.');
        }
    }
}
