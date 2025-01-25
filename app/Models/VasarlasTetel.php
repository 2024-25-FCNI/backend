<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VasarlasTetel extends Model
{
    /** @use HasFactory<\Database\Factories\VasarlasTetelFactory> */
    use HasFactory;

    protected $fillable = [
        'vasarlas_id',
        'termek_id',
        
    ];
}
