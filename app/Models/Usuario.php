<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property string $NomUsuario
 * @property string $Contrasenia
 * 
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuario';
	protected $primaryKey = 'NomUsuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Contrasenia'
	];

	public function personas()
	{
		return $this->belongsToMany(Persona::class, 'persona_usuario', 'NomUsuario', 'ID');
	}
}
