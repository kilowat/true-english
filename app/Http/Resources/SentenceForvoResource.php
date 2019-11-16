<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SentenceForvoResource extends JsonResource
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
            "audio_url" => $this->url,
            "en_text" => $this->en_text,
            "ru_text" => $this->ru_text,
            "ipa_text" => $this->ipa_text
        ];
    }
}
