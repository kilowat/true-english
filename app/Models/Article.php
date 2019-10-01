<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use QCod\ImageUp\HasImageUploads;

class Article extends Model
{
    use \Conner\Tagging\Taggable;
    use HasImageUploads;

    protected $guarded = [];

    protected static $imageFields = [
        'picture' => [
            'width' => 300,
            'height' => 220,
            'crop' => true,
        ]
    ];

    public function getPreviewTextAttribute()
    {
        return Str::limit($this->text, 120);
    }

    public function getShortDateAttribute()
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
