<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AudioResource extends JsonResource
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
            "id" => $this->id,
            "word_code" => $this->word_code,
            "url" => $this->url,
            "file_name" => $this->file_name,
            "mime" => $this->mime
        ];
    }
}
