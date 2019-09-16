<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $guarded = [];

    public function cards(){
        return $this->belongsToMany(
            'App\Models\WordCard',
            'word_card_words',
            'word',
            'card_id',
            'name',
            'id');
    }
}
