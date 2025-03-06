<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termek extends Model
{
    use HasFactory;

    protected $primaryKey = 'termek_id'; // Laravelnek megmondjuk, hogy ne az 'id'-t használja

    protected $fillable = [
        'cim',
        'leiras',
        'url',
        'hozzaferesi_ido',
        'ar',
        'jelzes',
        'kep'
    ];
}

