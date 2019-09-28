<?php

namespace App\Observers;

use App\Models\WordCard;
use App\Models\WordSection;

class WordCardObserver
{
    private  function makeUri(WordCard $wordCard)
    {
        $uri = WordSection::where('id', '=', $wordCard->section_id)->first()->uri;
        $uri.= "/".$wordCard->code;

        $wordCard->find($wordCard->id)->update(["uri" => $uri]);
    }

    /**
     * Handle the word card "created" event.
     *
     * @param  \App\WordCard  $wordCard
     * @return void
     */
    public function created(WordCard $wordCard)
    {
        $this->makeUri($wordCard);
    }

    /**
     * Handle the word card "updated" event.
     *
     * @param  \App\WordCard  $wordCard
     * @return void
     */
    public function updated(WordCard $wordCard)
    {
        $this->makeUri($wordCard);
    }

    /**
     * Handle the word card "deleted" event.
     *
     * @param  \App\WordCard  $wordCard
     * @return void
     */
    public function deleted(WordCard $wordCard)
    {
        //
    }

    /**
     * Handle the word card "restored" event.
     *
     * @param  \App\WordCard  $wordCard
     * @return void
     */
    public function restored(WordCard $wordCard)
    {
        //
    }

    /**
     * Handle the word card "force deleted" event.
     *
     * @param  \App\WordCard  $wordCard
     * @return void
     */
    public function forceDeleted(WordCard $wordCard)
    {
        //
    }
}
