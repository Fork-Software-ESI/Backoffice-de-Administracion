<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 
        'ubicacion',
    ];

    public static function getAlmacenes()  // REVISAR ESTO
    {
        return [
            ['id' => 1, 'ubicacion' => 'Ubicación A'],
            ['id' => 2, 'ubicacion' => 'Ubicación B'],
            ['id' => 3, 'ubicacion' => 'Ubicación C'],
        ];
    }
}
