<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VasarlasTetel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vasarlas_id',
        'termek_id',
    ];

    public function vasarlas()
    {
        return $this->belongsTo(VasarlasFej::class, 'vasarlas_id');
    }

    public function termek()
    {
        return $this->belongsTo(Termek::class, 'termek_id');
    }
}
