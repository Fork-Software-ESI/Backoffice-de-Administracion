<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Forma
 * 
 * @property int $ID_Lote
 * @property int $ID_Paquete
 * @property int $ID_Estado
 * 
 * @property Lote $lote
 * @property Paquete $paquete
 * @property GerenteForma $gerente_forma
 *
 * @package App\Models
 */
class Forma extends Model
{
	use SoftDeletes;
	protected $table = 'forma';
	protected $primaryKey = 'ID_Paquete';
	public $incrementing = false;
	public $timestamps = true;

	protected $casts = [
		'ID_Lote' => 'int',
		'ID_Paquete' => 'int',
		'ID_Estado' => 'int'
	];

	protected $fillable = [
		'ID_Lote',
		'ID_Paquete',
		'ID_Estado'
	];

	public function lote()
	{
		return $this->belongsTo(Lote::class, 'ID_Lote');
	}

	public function paquete()
	{
		return $this->belongsTo(Paquete::class, 'ID_Paquete');
	}

	public function gerente_forma()
	{
		return $this->hasOne(GerenteForma::class, 'ID_Paquete');
	}
}
