<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LoteCamion
 * 
 * @property int $ID_Camion
 * @property int $ID_Lote
 * @property Carbon $Fecha_Hora_Inicio
 * @property string $ID_Estado
 * 
 * @property Camion $camion
 * @property Lote $lote
 * @property CamionLlevaLote $camion_lleva_lote
 *
 * @package App\Models
 */
class LoteCamion extends Model
{
	use SoftDeletes;
	protected $table = 'lote_camion';
	protected $primaryKey = 'ID_Lote';
	public $incrementing = false;
	public $timestamps = true;

	protected $casts = [
		'ID_Camion' => 'int',
		'ID_Lote' => 'int',
		'Fecha_Hora_Inicio' => 'datetime',
		'ID_Estado' => 'int'
	];

	protected $fillable = [
		'ID_Camion',
		'ID_Lote',
		'Fecha_Hora_Inicio',
		'ID_Estado'
	];

	public function camion()
	{
		return $this->belongsTo(Camion::class, 'ID_Camion');
	}

	public function lote()
	{
		return $this->belongsTo(Lote::class, 'ID_Lote');
	}

	public function camion_lleva_lote()
	{
		return $this->hasOne(CamionLlevaLote::class, 'ID_Lote');
	}
}
