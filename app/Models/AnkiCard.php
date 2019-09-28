<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use QCod\ImageUp\HasImageUploads;

class AnkiCard extends Model
{
    use \Conner\Tagging\Taggable;
    use HasImageUploads;

    public $timestamps = true;

    protected $guarded = ['tags', 'file_anki'];

    protected static $imageFields = [
        'picture' => [
            'width' => 300,
            'height' => 220,
            'crop' => true,
        ]
    ];

    public function getPreviewPictureAttribute()
    {
        if($this->picture){
            return Storage::disk("public")->url($this->picture);
        }else{
            return '/images/default_pic.jpg';
        }
    }

    public function getFileUrlAttribute(){
        return Storage::disk("anki")->url($this->file_hash);
    }

    public function setActiveAttribute($value)
    {
        $value = $value == "on" ? 1 : 0;
        $this->attributes['active'] = $value;
    }

    public function getTagsAsStrAttribute()
    {
        if(!$this->tags) return "";
        $tags = [];

        foreach($this->tags as $tag_item){
            $tags[] = $tag_item->name;
        }

        return implode(",", $tags);
    }
}
