<?php

namespace App\Models;

use App\Services\TextAnalyze\WordParser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use QCod\ImageUp\HasImageUploads;

class WordCard extends Model
{
    use HasImageUploads;

    protected $guarded = ['update_content'];

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
            'word_card_words',
            'word',
            'card_id',
            'name',
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
        return $this->attributes['active'] = isset($value) ? 1 : 0;
    }

    /**
     * @param $text content text
     * @param $card_id id own card
     */
    public function insertWords($text, $card_id){
        $res = WordParser::getFrequency($text);

        $words_with_freq = $res->getKeyValuesByFrequency();

        $field_data = [];
        $words = [];

        foreach($words_with_freq as $word => $freq_value){
            $field_data[] = [
                'word' => $word,
                'card_id' => $card_id,
                'freq' => $freq_value,
            ];
            $words[] = [
                'name' => $word,
            ];
        }

        $wordCardModel = new WordCardWord();
        $wordModel = new Word();

        DB::transaction(function () use ($wordModel, $field_data, $wordCardModel, $words, $card_id){
            DB::table($wordModel->getTable())->insertOrIgnore($words);
            DB::table($wordCardModel->getTable())->where('card_id', '=', $card_id)->delete();
            DB::table($wordCardModel->getTable())->insert($field_data);
        });
    }
}
