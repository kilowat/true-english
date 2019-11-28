<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhraseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "word" => $this->word,
            "en_text" => $this->en_text,
            "ru_text" => $this->ru_text,
            "ipa_text" => $this->ipa_text,
            "audio" => $this->url,
        ];
    }
}
