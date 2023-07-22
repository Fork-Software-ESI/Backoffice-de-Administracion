<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'description',
        'peso_kg',
        'lote_id',
    ];

    // Definir la relación con el modelo de Lote
    public static function createPaquete($data)
    {
        foreach (self::$paquetes as $paquete) {       //verifica si ya existe un paquete con esa id
            if ($paquete['id'] === $data['id']) {
                return null;
            }
        }
        self::$paquetes[] = $data;   // aca agrega el paquete
        return $data;
    }
}
