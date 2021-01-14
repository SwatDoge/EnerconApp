<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stappen extends Model
{
    protected $table = 'stappen';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user() {
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'plaats',
        'veld',
        'turbine',
        // 'omschrijving',
        // 'voltooid',
        'datum',
    ];

    public function sl() {
        return $this->belongsToMany('App\Models\SL');
    }
}
