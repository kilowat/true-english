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

class SentenceForvo extends Model
{
    protected $table = "forvo";

    public function getUrlAttribute()
    {
        return  Storage::disk('forvo')->url($this->file_name);
    }

}