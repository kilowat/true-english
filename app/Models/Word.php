<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public function cards(){
        return $this->belongsToMany(
            'App\Models\WordCard',
            'word_cards_words',
            'word_id',
            'card_id',
            'id',
            'id');
    }
}
