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
}
