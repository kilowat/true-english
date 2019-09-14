<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Kalnoy\Nestedset\NodeTrait;
use QCod\ImageUp\HasImageUploads;

class WordSection extends Model

{
    use NodeTrait, HasImageUploads;

    private $routeName = 'word-collection.section';

    protected $guarded = ['_lft', '_rgt', 'parent_id'];

    protected static $imageFields = [
        'picture' => [
            'width' => 240,
            'height' => 220,
        ]
    ];

    public function getLinkAttribute(){
        return route($this->routeName, $this->code);
    }

    public function getSelectedAttribute(){
        return false;
    }

    public function getPreviewPictureAttribute(){
        if($this->picture){
            return '/storage/'.$this->picture;
        }else{
            return '/images/default_pic.jpg';
        }

    }

    public function setActiveAttribute($value)
    {
        return $this->attributes['active'] = isset($value)?1:0;
    }
}
