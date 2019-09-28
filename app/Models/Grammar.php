<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grammar extends Model
{
    public function section()
    {
        return  $this->belongsTo(
            GrammarSection::class,
            'section_id',
            'id'
        );
    }
}
