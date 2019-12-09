<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Synonym extends Model
{
    public function wordRel()
    {
        return $this->hasOne(Word::class, "name", "synonym");
    }
}
