<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'descripcion'];

    protected static $lotes = [];

    public static function getLotes()
    {
        // Simulamos la consulta a la base de datos con la matriz estática
        return self::$lotes;
    }

    public static function createLote($data)
    {
        // Generar un ID para el lote
        $id = count(self::$lotes) + 1;

        // Asignar el ID al array de datos
        $data['id'] = $id;

        // Agregar el lote a la matriz estática
        self::$lotes[] = $data;

        return $data;
    }
}
