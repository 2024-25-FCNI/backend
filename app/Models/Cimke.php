<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cimke extends Model
{
    /** @use HasFactory<\Database\Factories\CimkeFactory> */
    use HasFactory;
    protected $fillable = [
        'elnevezes'
    ];

    public function termekek()
    {
        return $this->belongsToMany(\App\Models\Termek::class, 'kapcsolos', 'cimke_id', 'termek_id');
    }
}
