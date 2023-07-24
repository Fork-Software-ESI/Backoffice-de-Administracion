<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trayectoria extends Model
{
    use HasFactory;
    protected $fillable = [       
        'id',                                
        'lote_id',
        'origen',
        'destino',
        'estado',
    ];

    protected $table = 'trayectorias';

    protected $primaryKey = 'id';
}
