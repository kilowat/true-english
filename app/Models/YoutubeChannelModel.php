<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 19.11.2019
 * Time: 12:23
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class YoutubeChannelModel extends Model
{
    protected $table = "youtube_channels";

    protected $guarded = [];
    public $statuses = [
        0 => "Wait parsing",
        1 => "Done parsing",
    ];

    public function section()
    {
        return $this->belongsTo('App\Models\WordSection', 'section_id', 'id');
    }
}