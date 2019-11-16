<?php

namespace App\Console\Commands;

use App\Services\Youtube\YoutubeParser;
use Illuminate\Console\Command;

class YoutubeParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'parse all video in chanel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parser = new YoutubeParser();
        $parser->run();
    }
}
