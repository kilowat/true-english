<?php

namespace App\Console\Commands;

use App\Imports\WordImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:import {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import word from excel file';

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
        Excel::import(new WordImport(), $this->argument('file'));
    }
}
