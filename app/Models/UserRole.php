<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'user_role';

    public function roles() {
        return $this->belongsToMany('App\Models\Roles');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
