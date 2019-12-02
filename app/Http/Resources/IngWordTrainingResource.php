<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngWordTrainingResource extends JsonResource
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
            'word' => $this->word,
            'ru' => $this->translate,
            'ipa' => $this->transcription,
            'answer' => $this->answer
        ];
    }
}
