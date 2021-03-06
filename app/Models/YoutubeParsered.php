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
    protected $guarded = [];
    protected $table = "youtube";

    public $statuses = [
        0 => "Wait parsing",
        1 => "Done parsing",
        2 => "Done sync",
        3 => "Error"
    ];

    public function section()
    {
        return $this->belongsTo('App\Models\WordSection', 'section_id', 'id');
    }
}
