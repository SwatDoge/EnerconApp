<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = 'user_role';

    protected $fillable = [
        'role_id',
        'user_id',
    ];

    public function roles() {
        return $this->belongsToMany('App\Models\Roles');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
