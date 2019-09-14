<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use QCod\ImageUp\HasImageUploads;

class WordCard extends Model
{
    use HasImageUploads;

    protected $guarded = [];

    protected static $imageFields = [
        'picture' => [
            'width' => 240,
            'height' => 220,
        ]
    ];

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

    public function section(){
        return $this->belongsTo('App\Models\WordSection', 'section_id', 'id');
    }

    public function getPreviewPictureAttribute(){
        if($this->picture){
            return '/storage/'.$this->picture;
        }else{
            return '/images/default_pic.jpg';
        }
    }

    public function setActiveAttribute($value)
    {
        return $this->attributes['active'] = isset($value)?1:0;
    }
}
