<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RegistrosAcceso
 * 
 * @property int $registro_id
 * @property int $usuario_id
 * @property int|null $carnet_id
 * @property int|null $sede_id
 * @property Carbon $fecha_hora_acceso
 * @property string $tipo_accion
 * @property int|null $lector_id
 * 
 * @property Carnet|null $carnet
 * @property Sede|null $sede
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class RegistrosAcceso extends Model
{
	protected $table = 'registros_acceso';
	protected $primaryKey = 'registro_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'registro_id' => 'int',
		'usuario_id' => 'int',
		'carnet_id' => 'int',
		'sede_id' => 'int',
		'fecha_hora_acceso' => 'datetime',
		'lector_id' => 'int'
	];

	protected $fillable = [
		'usuario_id',
		'carnet_id',
		'sede_id',
		'fecha_hora_acceso',
		'tipo_accion',
		'lector_id'
	];

	public function carnet()
	{
		return $this->belongsTo(Carnet::class);
	}

	public function sede()
	{
		return $this->belongsTo(Sede::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
