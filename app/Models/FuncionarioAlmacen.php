<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FuncionarioAlmacen
 * 
 * @property int $ID
 * 
 * @property Persona $persona
 * @property Collection|FuncionarioForma[] $funcionario_formas
 * @property Collection|FuncionarioPaqueteEstante[] $funcionario_paquete_estantes
 *
 * @package App\Models
 */
class FuncionarioAlmacen extends Model
{
	use SoftDeletes;
	protected $table = 'funcionario_almacen';
	protected $primaryKey = 'ID';
	public $incrementing = false;
	public $timestamps = true;

	protected $fillable = [
		'ID',
		'ID_Almacen'
	];
	protected $casts = [
		'ID' => 'int',
		'ID_Almacen' => 'int'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'ID');
	}

	public function funcionario_formas()
	{
		return $this->hasMany(FuncionarioForma::class, 'ID_Funcionario');
	}

	public function funcionario_paquete_estantes()
	{
		return $this->hasMany(FuncionarioPaqueteEstante::class, 'ID_Funcionario');
	}
}
