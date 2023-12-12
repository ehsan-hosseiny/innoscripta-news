<?php

namespace App\Console\Commands;

use App\Services\NewsApiFactory;
use Illuminate\Console\Command;

class FetchNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get news';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sources = config('sources.list');

        foreach ($sources as  $source){
            $api = NewsApiFactory::createApi($source);
            $api->fetchNews();
        }

    }
}
