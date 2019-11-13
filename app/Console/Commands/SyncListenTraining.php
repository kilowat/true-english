<?php

namespace App\Console\Commands;

use App\Models\Word;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncListenTraining extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listen:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync phrase training with words';

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
        $words = DB::table('words')
            ->where('listen_training', '=', 0)
            ->selectRaw('DISTINCT(word) as name')
            ->selectRaw('COUNT(word) as count')
            ->leftJoin('sentence_word', function($join){
                $join->on('sentence_word.word', '=', 'words.name');
            })
            ->leftJoin('sentence_forvo', function($join){
                $join->on('sentence_word.file_name', '=', 'sentence_forvo.file_name');
            })
            ->whereNotNull('sentence_word.word')
            ->whereRaw('length(words.name) > 2')
            ->where('sentence_word.file_name','>', '')
            ->groupBy('word')
            ->having('count', '>', 1)
            ->get();

        /*
        $wordsReset = Word::all();

        foreach ($wordsReset as $word2){
            Word::where('name', '=', $word2->name)
                ->update(['phrase_training' => 0]);
        }
        */

        foreach ($words as $word){
            Word::where('name', '=', $word->name)
                ->update(['listen_training' => $word->count]);
        }
    }
}
