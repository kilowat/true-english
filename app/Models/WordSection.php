<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Kalnoy\Nestedset\NodeTrait;

class WordSection extends Model

{
    use NodeTrait;

    private $routeName = 'word-collection.section';

    public function getLinkAttribute(){
        return route($this->routeName, $this->code);
    }

    public function getSelectedAttribute(){
        return false;
    }

    public function getPreviewPictureAttribute(){
        //todo  Add link to list pic
        return $this->picture;
    }
}
