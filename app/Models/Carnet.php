<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carnet
 * 
 * @property int $carnet_id
 * @property int $usuario_id
 * @property string $qr_code_data
 * @property Carbon $fecha_emision
 * @property Carbon|null $fecha_vencimiento
 * @property string|null $estado_carnet
 * 
 * @property Usuario $usuario
 * @property Collection|RegistrosAcceso[] $registros_accesos
 *
 * @package App\Models
 */
class Carnet extends Model
{
	protected $table = 'carnets';
	protected $primaryKey = 'carnet_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'carnet_id' => 'int',
		'usuario_id' => 'int',
		'fecha_emision' => 'datetime',
		'fecha_vencimiento' => 'datetime'
	];

	protected $fillable = [
		'usuario_id',
		'qr_code_data',
		'fecha_emision',
		'fecha_vencimiento',
		'estado_carnet'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function registros_accesos()
	{
		return $this->hasMany(RegistrosAcceso::class);
	}
}
