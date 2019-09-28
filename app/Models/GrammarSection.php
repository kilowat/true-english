<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use QCod\ImageUp\HasImageUploads;

class GrammarSection extends Model
{
    use HasImageUploads;

    protected $guarded = [];

    protected static $imageFields = [
        'picture' => [
            'width' => 300,
            'height' => 220,
            'crop' => true,
        ]
    ];


    public function elements()
    {
        return $this->hasMany(
            Grammar::class,
            "section_id",
            "id"
        );
    }

    public function setActiveAttribute($value)
    {
        $value = $value == "on" ? 1 : 0;
        $this->attributes['active'] = $value;
    }

    public function getPreviewPictureAttribute()
    {
        if($this->picture){
            return Storage::disk("public")->url($this->picture);
        }else{
            return '/images/default_pic.jpg';
        }
    }
}
