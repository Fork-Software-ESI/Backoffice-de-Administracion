<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Camion extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricula',
        'pesoMaximo',
    ];

    // Nombre de la tabla en la base de datos
    protected $table = 'camiones';

    // Indicar la clave primaria personalizada (si es diferente a 'id')
    protected $primaryKey = 'matricula';
}
