<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordCard extends Model
{
    public static function makeUrlToDetail($parent_section_code, $current_section_code, $code){
        return route('word-collection.section', $parent_section_code, $current_section_code)
            ."/".$current_section_code
            ."/".$code.".html";
    }

    public function words(){
        return $this->belongsToMany(
            'App\Models\Word',
            'word_cards_words',
            'word_id',
            'card_id',
            'id',
            'id');
    }
}
/*
 *     public function belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null,
                                  $parentKey = null, $relatedKey = null, $relation = null)
 */