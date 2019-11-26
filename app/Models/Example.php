<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 26.11.2019
 * Time: 18:14
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $table = "examples";

    public function getItemsAttribute()
    {
        return json_decode($this->attributes['json_text']);
    }
}