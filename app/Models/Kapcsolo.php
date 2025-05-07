<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapcsolo extends Model
{
    /** @use HasFactory<\Database\Factories\KapcsoloFactory> */
    use HasFactory;
    protected $fillable = [
        'termek_id',
        'cimke_id',     
    ];
}
