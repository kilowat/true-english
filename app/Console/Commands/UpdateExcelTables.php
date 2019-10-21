<?php

namespace App\Console\Commands;

use App\Exports\CardExport;
use App\Models\WordCard;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class UpdateExcelTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update or create excel tables for cards';

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
        $cardIds = WordCard::select('id')->pluck('id')->all();
        $startTime = 'start task at:'. Carbon::now();
        $count = 0;
        $this->info($startTime);

        $messageToLog = PHP_EOL."Start update excel table: ".count($cardIds). " ".$startTime;

        $bar = $this->output->createProgressBar(count($cardIds));

        $bar->start();

        foreach($cardIds as $id){
            $this->update($id);
            $bar->advance();
            $count++;
        }

        $bar->finish();
        $endTime = PHP_EOL.'end task at:'. Carbon::now();

        $this->info($endTime);

        $messageToLog.= PHP_EOL."End update excel table: ".$count. " ".$endTime;

        Log::info($messageToLog);

    }

    private function update($id)
    {
        $wordCard = WordCard::find($id);
        $words = [];
        $wordQuery = $wordCard->words;

        foreach($wordQuery as $item){

            $words[] = $item->word;
        }

        $file_name = $wordCard->code.".xlsx";

        if(Excel::store(new CardExport($words, $id), $file_name, 'excel')){
            $wordCard->find($id)->update(["excel_file" => $file_name]);
        }
    }
}
