<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Csomagban extends Model
{
    /** @use HasFactory<\Database\Factories\CsomagbanFactory> */
    use HasFactory;

    protected $fillable = [
        'termek_id',
       
    ];

    /**
     * Kapcsolat a Termek modellel.
     */
    public function termek()
    {
        return $this->belongsTo(Termek::class, 'termek_id');
    }
}
