<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rollen extends Model
{
    use HasFactory;

    public function rol()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
