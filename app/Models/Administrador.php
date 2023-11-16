<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Administrador
 * 
 * @property int $ID
 * 
 * @property Persona $persona
 *
 * @package App\Models
 */
class Administrador extends Model
{
	use SoftDeletes;
	protected $table = 'administrador';
	protected $primaryKey = 'ID';
	public $incrementing = false;
	public $timestamps = true;

	protected $fillable = [
		'ID'
	];
	protected $casts = [
		'ID' => 'int'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'ID');
	}
}
