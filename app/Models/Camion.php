<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    use HasFactory;

    //protected static $camiones = [];  --averiguar como funciona con la base de datos
    protected $fillable = [
        'matricula', 
        'modelo', 
        'capacidad_carga'   // PesoMaximoKg MER
    ];
    protected static $camiones = [];
    public static function getCamiones()
    {
        return self::$camiones;
    }
    public static function createCamion($data)
    {
        foreach (self::$camiones as $camion) {              // Verificar si ya existe un camión con la misma matrícula
            if ($camion['matricula'] === $data['matricula']) {
                return null;                                // Ya existe un camión con la misma matrícula
            }
        }
        self::$camiones[] = $data;                          // Agregar el camión a la matriz estática
        return $data;
    }
}
