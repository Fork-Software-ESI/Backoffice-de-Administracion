<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    use HasFactory;
    protected $fillable = [
        'matricula',
        'pesoMaximoKg'
    ];
    protected $primaryKey = 'id';
    protected $table='camiones';
}
