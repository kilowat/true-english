<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class WordSection extends Model

{
    use NodeTrait;

    public function getLinkAttribute(){
        return route('word-collection.section', $this->id);
    }
}
