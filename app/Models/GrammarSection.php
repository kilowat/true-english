<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrammarSection extends Model
{
    public function elements(){
        return $this->hasMany(
            Grammar::class,
            "section_id",
            "id"
        );
    }
}
