<?php

namespace App\Models;

use App\Services\Subtitles\SubtitleCreator;
use App\Services\TextAnalyze\WordParser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use QCod\ImageUp\HasImageUploads;

class WordCard extends Model
{
    use HasImageUploads;
    public $timestamps = true;

    protected $guarded = ['update_content', 'create_excel', 'create_transcript'];

    protected static $imageFields = [
        'picture' => [
            'width' => 300,
            'height' => 220,
            'crop' => true,
        ]
    ];

    public function words(){
        return $this->hasMany(
            'App\Models\WordCardWord',
            'card_id',
            'id'
        );

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

    public function getShortDataAttribute(){
        $data = new Carbon($this->created_at);
        return $data->format('d.m.Y');
    }

    public function getLinkAttribute(){
         return route("word-collection.detail", $this->uri);
    }

    public function setActiveAttribute($value)
    {
        $value = $value == "on" ? 1 : 0;
        $this->attributes['active'] = $value;
    }

    public function getSubtitleAttribute(){
        if(!empty($this->ensubtitle)){
            $creator = new SubtitleCreator($this->ensubtitle, $this->rusubtitle, $this->trsubtitle);
            return $creator->merge();
        }
        return [];
    }

    public function getExcelAttribute(){
        return  Storage::disk('excel')->url($this->excel_file);
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
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
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
