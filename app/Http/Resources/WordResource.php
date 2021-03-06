<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WordResource extends JsonResource
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
            "freq" => $this->freq,
            "name" => $this->name,
            "transcription" => $this->transcription,
            "translate" => $this->translate,
            "audio" => new AudioResource($this->whenLoaded('audio')),
            "contextReversoLink" => $this->contextReversoLink,
            "forvoLink" => $this->forvoLink,
            "wordHuntLink" => $this->wordHuntLink,
            "meriamlLink" => $this->meriamlLink,
            "yandexLink" => $this->yandexLink,
            "phraseTraining" => $this->phrase_training,
            "listenTraining" => $this->listen_training,
        ];
    }
}
