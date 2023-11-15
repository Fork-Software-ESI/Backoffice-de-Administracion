<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ChoferTipoLibretum
 * 
 * @property int $ID
 * @property string $Tipo
 * 
 * @property Chofer $chofer
 * @property TipoLibretum $tipo_libretum
 *
 * @package App\Models
 */
class ChoferTipoLibretum extends Model
{
	use SoftDeletes;
	protected $table = 'chofer_tipo_libreta';
	public $incrementing = false;
	public $timestamps = true;

	protected $casts = [
		'ID' => 'int',
		'Tipo' => 'string'
	];

	protected $fillable = [
		'ID',
		'Tipo'
	];

	public function chofer()
	{
		return $this->belongsTo(Chofer::class, 'ID');
	}

	public function tipo_libretum()
	{
		return $this->belongsTo(TipoLibretum::class, 'Tipo');
	}
}
