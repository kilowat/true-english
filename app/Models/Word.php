<?php

namespace App\Models;

use App\Models\Eloquent\ModelCI;
use Illuminate\Database\Eloquent\Model;

class Word extends ModelCI
{
    protected $guarded = [];

    public function cards()
    {
        return $this->belongsToMany(
            'App\Models\WordCard',
            'word_card_words',
            'word',
            'card_id',
            'name',
            'id');
    }

    public function getContextReversoLinkAttribute()
    {
        return "https://dictionary.reverso.net/english-russian/".$this->name;
    }

    public function getWordHuntLinkAttribute()
    {
        return "https://wooordhunt.ru/word/".$this->name;
    }

    public function getMeriamlLinkAttribute()
    {
        return "https://www.merriam-webster.com/dictionary/".$this->name;
    }

    public function getYandexLinkAttribute()
    {
        return "https://translate.yandex.ru/?lang=en-ru&text=".$this->name;
    }

    public function getAudioLinkAttribute()
    {
        return 'audio/'.$this->name.'.mp3';
    }

    public function getYouglishLinkAttribute()
    {
        return "https://youglish.com/search/".$this->name."/all";
    }

    public function audio()
    {
        return $this->hasOneCI(
            '\App\Models\Audio',
            'word_code',
            'name'
        );
    }

    public function setCheckedAttribute($value)
    {
        $value = $value == "on" ? 1 : 0;
        $this->attributes['checked'] = $value;
    }
}
