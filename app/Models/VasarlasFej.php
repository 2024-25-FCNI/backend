<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VasarlasFej extends Model
{
    use HasFactory;

    protected $table = 'vasarlas_fejs'; 
    protected $primaryKey = 'vasarlas_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'osszeg',
        'datum'
    ];
    

     public function vasarlasTetel()
    {
        return $this->hasMany(VasarlasTetel::class, 'vasarlas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
}
