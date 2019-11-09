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
            //->where('phrase_training', '=', 0)
            ->selectRaw('DISTINCT(word) as name')
            ->selectRaw('COUNT(word) as count')
            ->leftJoin('phrases', function($join){
                $join->on('phrases.word', '=', 'words.name');
            })
            ->whereNotNull('phrases.word')
            ->whereRaw('length(words.name) > 2')
            ->where('phrases.file_name','>', '')
            ->groupBy('word')
            ->having('count', '>', 1)
            ->get();

        foreach ($words as $word){
            Word::where('name', '=', $word->name)
                ->update(['phrase_training' => $word->count]);
        }
    }
}
