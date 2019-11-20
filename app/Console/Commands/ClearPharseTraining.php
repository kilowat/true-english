<?php

namespace App\Console\Commands;

use App\Models\Word;
use Illuminate\Console\Command;

class ClearPharseTraining extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:phrase_training';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'set 0 in word table coll phrase_training';

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
        $wordsReset = Word::all();

        foreach ($wordsReset as $word){
            Word::where('name', '=', $word->name)
                ->update(['phrase_training' => 0]);
        }
    }
}
