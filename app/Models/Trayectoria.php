<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trayectoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'lote_id',
        'origen',
        'destino',
        'estado',
    ];

    protected static $trayectorias = [];

    public static function getTrayectorias()
    {
        // Simulamos la consulta a la base de datos con la matriz estática
        return self::$trayectorias;
    }

    public static function createTrayectoria($data)
    {
        // Agregar la trayectoria a la matriz estática
        self::$trayectorias[] = $data;

        return $data;
    }
}
