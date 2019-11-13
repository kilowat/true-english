<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 06.11.2019
 * Time: 22:10
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Phrase extends Model
{

    protected $primaryKey = 'word';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getRuTextAttribute()
    {
        return explode("|", $this->attributes["ru_text"]);
    }
    public function getUrlAttribute()
    {
        return  Storage::disk('phrases')->url($this->file_name);
    }
}