<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Estante
 * 
 * @property int $ID
 * @property int $ID_Almacen
 * 
 * @property Almacen $almacen
 * @property Collection|Paquete[] $paquetes
 *
 * @package App\Models
 */
class Estante extends Model
{
	use SoftDeletes;
	protected $table = 'estante';
	protected $primaryKey = 'ID';
	public $incrementing = true;
	public $timestamps = true;
	protected $dates = ['deleted_at'];

	protected $fillable = [
		'ID_Almacen'
	];
	protected $casts = [
		'ID_Almacen' => 'int'
	];

	public function almacen()
	{
		return $this->belongsTo(Almacen::class, 'ID_Almacen');
	}

	public function paquetes()
	{
		return $this->belongsToMany(Paquete::class, 'paquete_estante', 'ID_Estante', 'ID_Paquete')
					->withPivot('ID_Almacen');
	}
}
