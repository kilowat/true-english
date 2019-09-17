<?php

namespace App\Observers;

use App\Models\WordCard;

class WordCardObserver
{
    /**
     * Handle the word card "created" event.
     *
     * @param  \App\WordCard  $wordCard
     * @return void
     */
    public function created(WordCard $wordCard)
    {
        //
    }

    /**
     * Handle the word card "updated" event.
     *
     * @param  \App\WordCard  $wordCard
     * @return void
     */
    public function updated(WordCard $wordCard)
    {
        //
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
