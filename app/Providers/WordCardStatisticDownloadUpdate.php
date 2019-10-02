<?php

namespace App\Providers;

use App\Models\WordCard;
use App\Providers\WordCardExcelDownloaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WordCardStatisticDownloadUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  WordCardExcelDownloaded  $event
     * @return void
     */
    public function handle(WordCardExcelDownloaded $event)
    {
        if($event->wordCard){
            $event->wordCard->increment('excel_downloaded');
        }
    }
}
