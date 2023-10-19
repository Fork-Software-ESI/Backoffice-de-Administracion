<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaTelefono extends Model
{
    protected $table = 'persona_telefono';
    public $timestamps = false;

    protected $fillable = ['ID', 'ID_Persona', 'Telefono'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'ID_Persona', 'ID');
    }
}
