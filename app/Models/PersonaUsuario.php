<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonaUsuario
 * 
 * @property int $ID
 * @property int $ID_Usuario
 * @property int $ID_Persona
 * 
 * @property Persona $persona
 * @property User $usuario
 *
 * @package App\Models
 */
class PersonaUsuario extends Model
{
	use SoftDeletes;
	protected $table = 'persona_usuario';
	public $incrementing = false;
	protected $primaryKey = 'ID_Persona';
	public $timestamps = true;

	protected $fillable = [
		'ID_Usuario',
		'ID_Persona',
	];
	protected $casts = [
		'ID_Persona' => 'int',
		'ID_Usuario' => 'int'
	];

	public function usuario()
	{
		return $this->belongsTo(User::class, 'ID_Usuario', 'ID');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'ID_Persona', 'ID');
	}
}
