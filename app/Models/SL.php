<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SL extends Model
{
    protected $table = 'switchbriefs';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user() {
        return $this->belongsTo('App\User');
    }
    protected $casts = [
        'stap' => 'array',
        'plaats' => 'array',
        'veld' => 'array',
        'turbine' => 'array'
    ];
}
