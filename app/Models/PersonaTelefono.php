<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaTelefono extends Model
{
    use SoftDeletes;
    protected $table = 'persona_telefono';
    public $timestamps = false;
    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID_Persona', 
        'Telefono'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'ID_Persona', 'ID');
    }
}
