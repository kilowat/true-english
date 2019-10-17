<?php

namespace App\Models;

use App\Services\Subtitles\SubtitleCreator;
use App\Services\TextAnalyze\WordParser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravelista\Comments\Commentable;
use QCod\ImageUp\HasImageUploads;

class WordCard extends Model
{
    use HasImageUploads, Commentable;

    public $timestamps = true;

    protected $guarded = ['update_content', 'create_excel', 'create_transcript', 'parse_content'];

    protected static $imageFields = [
        'picture' => [
            'width' => 300,
            'height' => 220,
            'crop' => true,
        ]
    ];

    public function words()
    {
        return $this->hasMany(
            'App\Models\WordCardWord',
            'card_id',
            'id'
        );

    }

    public function section()
    {
        return $this->belongsTo('App\Models\WordSection', 'section_id', 'id');
    }

    public function getPreviewPictureAttribute()
    {
        if($this->picture){
            return Storage::disk("public")->url($this->picture);
        }else{
            return '/images/default_pic.jpg';
        }
    }

    public function getShortDataAttribute()
    {
        $data = new Carbon($this->created_at);
        return $data->format('d.m.Y');
    }

    public function getLinkAttribute()
    {
         return route("word-collection.detail", $this->uri);
    }

    public function setActiveAttribute($value)
    {
        $value = $value == "on" ? 1 : 0;
        $this->attributes['active'] = $value;
    }

    public function setPhraseAttribute($value)
    {
        $value = $value == "on" ? 1 : 0;
        $this->attributes['phrase'] = $value;
    }

    public function getJsonSubtitlesAttribute()
    {
        return $this->attributes["subtitles"];
    }

    public function setSubtitlesAttribute($value)
    {
        $this->attributes["subtitles"] = json_encode($value);
    }

    public function getSubtitlesAttribute(){
        return json_decode($this->attributes["subtitles"]);
    }

    public function getExcelAttribute()
    {
        $exists = Storage::disk('excel')->exists($this->excel_file);

        if($exists){
            return  Storage::disk('excel')->url($this->excel_file);
        }else{
            return false;
        }
    }

    public function getExcelPathAttribute()
    {
        return "/storage/excel/".$this->excel_file;
    }

    /**
     * @param $text content text
     * @param $card_id id own card
     */
    public function insertWords($text, $card_id, $useFreqParser = false)
    {
        $words_parsered = [];

        if($useFreqParser){
            $words_parsered = $this->useParser($text);
        }else{
            $words_parsered = $this->useSimpleArray($text);
        }

        $field_data = [];
        $words = [];

        foreach($words_parsered as $word => $freq_value){
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
            $words = trim($words);
            DB::table($wordModel->getTable())->insertOrIgnore($words);
            DB::table($wordCardModel->getTable())->where('card_id', '=', $card_id)->delete();
            DB::table($wordCardModel->getTable())->insert($field_data);
        });
    }

    private function useParser($text)
    {
        $res = WordParser::getFrequency($text);

        $words_parsered = $res->getKeyValuesByFrequency();

        return $words_parsered;
    }

    private function useSimpleArray($text)
    {
        $arr_tmp = explode(PHP_EOL, $text);

        $words_parsered = [];

        foreach($arr_tmp as $word){
            $word = trim($word);
            $words_parsered[$word] = 1;
        }

        return $words_parsered;
    }
}
