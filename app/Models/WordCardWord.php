<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordCardWord extends Model
{
    public function section()
    {
        return $this->belongsTo('App\Models\WordSection', 'section_id', 'id');
    }
}
