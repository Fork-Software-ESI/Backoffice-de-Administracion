<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CamionPlataformaSalida
 * 
 * @property int $ID_Camion
 * @property int $ID_Almacen
 * @property int $Numero_Plataforma
 * @property Carbon $Fecha_Hora_Salida
 * 
 * @property CamionPlataforma $camion_plataforma
 *
 * @package App\Models
 */
class CamionPlataformaSalida extends Model
{
	protected $table = 'camion_plataforma_salida';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_Camion' => 'int',
		'ID_Almacen' => 'int',
		'Numero_Plataforma' => 'int',
		'Fecha_Hora_Salida' => 'datetime'
	];

	protected $fillable = [
		'Fecha_Hora_Salida'
	];

	public function camion_plataforma()
	{
		return $this->belongsTo(CamionPlataforma::class, 'ID_Camion')
					->where('camion_plataforma.ID_Camion', '=', 'camion_plataforma_salida.ID_Camion')
					->where('camion_plataforma.ID_Almacen', '=', 'camion_plataforma_salida.ID_Almacen')
					->where('camion_plataforma.Numero_Plataforma', '=', 'camion_plataforma_salida.Numero_Plataforma');
	}
}
