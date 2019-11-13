<?php

namespace App\Console\Commands;

use App\Models\Phrase;
use App\Models\Word;
use App\Services\TextAnalyze\WordParser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SearchWordInPhrases extends Command
{
    private $bar;
    private $wordModel;
    private $phraseModel;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:search';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Word $wordModel, Phrase $phraseModel)
    {
        parent::__construct();

        $this->wordModel = $wordModel;
        $this->phraseModel = $phraseModel;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = $this->getCount();
        $this->bar = $this->output->createProgressBar($count);

        $this->bar->start();

        while ($this->getCount() > 0)
        {
            $this->step();
            $this->bar->advance();
        }

        $this->bar->finish();
    }


    private function getCount()
    {
        return Phrase::where("checked", "=", 0)->count();
    }

    private function step()
    {
        $this->phraseModel->where("checked", "=", 0)->chunk(1000, function ($phrases){
            $str = "";
            $phraseRowscode = [];

            foreach ($phrases as $phrase) {
                $phraseRowscode[] = $phrase->file_name;
                $str.= " ".$phrase->en_text;
            }

            $words = $this->parseText($str);

            DB::transaction(function() use($words, $phraseRowscode){
                DB::table($this->wordModel->getTable())->insertOrIgnore($words);

                foreach ($phraseRowscode as $code){
                    DB::table($this->phraseModel->getTable())->where('file_name', '=', $code)->update(['checked'=>1]);
                }
            });
        });

    }

    private function parseText($text)
    {
        $res = WordParser::getFrequency($text);
        $words_parsered = $res->getKeyValuesByFrequency();
        $words = [];

        foreach($words_parsered as $word => $freq_value){
            $words[] = [
                'name' => $word,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ];
        }

        return $words;
    }
}
