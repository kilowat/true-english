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

    public function getContextReversoLinkAttribute(){
        return "https://dictionary.reverso.net/english-russian/".$this->name;
    }

    public function audio(){
        return $this->hasOne(
            '\App\Models\Audio',
            'word_code',
            'name'
        );
    }

    public function setCheckedAttribute($value){
        $value = $value == "on" ? 1 : 0;
        $this->attributes['checked'] = $value;
    }
}
