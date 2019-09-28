<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Kalnoy\Nestedset\NodeTrait;
use QCod\ImageUp\HasImageUploads;

class WordSection extends Model
{
    use NodeTrait, HasImageUploads;

    public $timestamps = true;

    protected $guarded = ['_lft', '_rgt', 'parent_id'];

    protected static $imageFields = [
        'picture' => [
            'width' => 240,
            'height' => 220,
        ]
    ];

    public function getLinkAttribute()
    {
        return route('word-collection.section',$this->uri);
    }

    public function getShortDataAttribute()
    {
        $data = new Carbon($this->created_at);
        return $data->format('d.m.Y');
    }

    public function getPreviewPictureAttribute()
    {
        if($this->picture){
            return Storage::disk("public")->url($this->picture);
        }else{
            return '/images/default_pic.jpg';
        }
    }

    public function setActiveAttribute($value)
    {
        $value = $value == "on" ? 1 : 0;
        $this->attributes['active'] = $value;
    }
}
