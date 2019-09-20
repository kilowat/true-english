<?php

namespace App\Observers;

use App\Models\WordSection;

class WordSectionObserver
{
    private  function makeUri(WordSection $wordSection){
        $items = WordSection::ancestorsAndSelf($wordSection->id);
        $code_arr = [];

        foreach ($items as $item){
            $code_arr[] = $item->code;
        }

        $uri = implode("/", $code_arr);

        $wordSection->find($wordSection->id)->update(["uri" => $uri]);
    }

    /**
     * Handle the word section "created" event.
     *
     * @param  \App\Models\WordSection  $wordSection
     * @return void
     */
    public function created(WordSection $wordSection)
    {
         $this->makeUri($wordSection);
    }

    /**
     * Handle the word section "updated" event.
     *
     * @param  \App\Models\WordSection  $wordSection
     * @return void
     */
    public function updated(WordSection $wordSection)
    {
        $this->makeUri($wordSection);
    }

    /**
     * Handle the word section "deleted" event.
     *
     * @param  \App\Models\WordSection  $wordSection
     * @return void
     */
    public function deleted(WordSection $wordSection)
    {
        //
    }

    /**
     * Handle the word section "restored" event.
     *
     * @param  \App\Models\WordSection  $wordSection
     * @return void
     */
    public function restored(WordSection $wordSection)
    {
        //
    }

    /**
     * Handle the word section "force deleted" event.
     *
     * @param  \App\Models\WordSection  $wordSection
     * @return void
     */
    public function forceDeleted(WordSection $wordSection)
    {
        //
    }
}
