<?php

namespace App\Console\Commands;

use App\Models\Word;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncPhraseTraining extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phrase:sync';

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
            ->where('phrase_training', '=', 0)
            ->selectRaw('DISTINCT(word) as name')
            ->selectRaw('COUNT(word) as count')
            ->leftJoin('phrases_word', function($join){
                $join->on('phrases_word.word', '=', 'words.name');
            })
            ->leftJoin('phrases', function($join){
                $join->on('phrases_word.file_name', '=', 'phrases.file_name');
            })
            ->whereNotNull('phrases_word.word')
            ->whereRaw('length(words.name) > 2')
            ->where('phrases_word.file_name','>', '')
            ->where('phrases.ru_text', '!=', '')
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
                ->update(['phrase_training' => $word->count]);
        }
    }
}
