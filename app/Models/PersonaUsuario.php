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
 * @property int $ID_Usuario
 * @property int $ID_Persona
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
	protected $primaryKey = ['ID_Persona', 'ID_Usuario'];
	public $timestamps = true;

	protected $fillable = [
		'ID_Usuario',
		'ID_Persona',
	];
	protected $casts = [
		'ID' => 'int'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'ID_Usuario', 'ID');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'ID_Persona', 'ID');
	}
}
