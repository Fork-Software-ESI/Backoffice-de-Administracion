<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property string $username
 * @property string $password
 * 
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class User extends Model
{
	use HasFactory;
	protected $table = 'users';
	protected $primaryKey = 'username';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'password'
	];

	public function personas()
	{
		return $this->belongsToMany(Persona::class, 'persona_usuario', 'username', 'ID');
	}
}
