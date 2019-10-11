<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pronons extends Model
{
    protected $guarded = [];

    public function setActiveAttribute($value)
    {
        $value = $value == "on" ? 1 : 0;
        $this->attributes['active'] = $value;
    }
}
