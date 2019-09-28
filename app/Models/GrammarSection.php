<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrammarSection extends Model
{
    protected $guarded = [];

    public function elements()
    {
        return $this->hasMany(
            Grammar::class,
            "section_id",
            "id"
        );
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
