<?php

namespace App\Models;

use App\Models\Eloquent\ModelCI;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Audio extends ModelCI
{
    public $timestamps = true;
    protected $guarded = [];

    public function getUrlAttribute()
    {
        return  Storage::disk('audio')->url($this->file_name);
    }

    public function word()
    {
        return $this->belongsToCI(Word::class, 'name', "word_code");
    }
}
