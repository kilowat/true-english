<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 17.11.2019
 * Time: 19:34
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class YoutubeParsered extends Model
{
    protected $table = "youtube";
    protected $primaryKey = "code";
}
