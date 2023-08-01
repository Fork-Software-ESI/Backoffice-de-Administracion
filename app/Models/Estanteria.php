<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estanteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'almacen_id',
    ];
    protected $primaryKey = 'id';
    protected $table='estanterias';

}
