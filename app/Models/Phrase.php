<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 06.11.2019
 * Time: 22:10
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    public function getRuTextAttribute()
    {
        return explode("|", $this->attributes["ru_text"]);
    }
}