<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaUsuario
 * 
 * @property int $ID
 * @property string $NomUsuario
 * 
 * @property Persona $persona
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class PersonaUsuario extends Model
{
	protected $table = 'persona_usuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'ID_Persona',
		'ID_Usuario'
	];

	protected $casts = [
		'ID' => 'int'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'ID_Persona', 'ID');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'ID_Usuario', 'ID');
	}
}
