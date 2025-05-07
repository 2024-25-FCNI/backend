<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termek extends Model
{
    use HasFactory;

    protected $primaryKey = 'termek_id';

    protected $fillable = [
        'cim',
        'bemutatas',
        'leiras',
        'url',
        'hozzaferesi_ido',
        'ar',
        'jelzes',
        'kep'
    ];

    public function cimkek()
    {
        return $this->belongsToMany(\App\Models\Cimke::class, 'kapcsolos', 'termek_id', 'cimke_id', 'termek_id', 'cimke_id');
    }
}
