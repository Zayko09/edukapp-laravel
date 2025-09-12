<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $usuario_id
 * @property string $numero_documento
 * @property string $hash_contrasena
 * @property string $salt_contrasena
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string|null $foto_url
 * @property Carbon|null $fecha_ultimo_acceso
 * @property bool $activo
 * @property Carbon $fecha_creacion
 * @property int|null $rol_id
 * @property int|null $sede_id
 * @property int|null $jornada_id
 * @property int|null $ficha_id
 * 
 * @property Ficha|null $ficha
 * @property Jornada|null $jornada
 * @property Role|null $role
 * @property Sede|null $sede
 * @property Carnet|null $carnet
 * @property Collection|RegistrosAcceso[] $registros_accesos
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuarios';
	protected $primaryKey = 'usuario_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'fecha_ultimo_acceso' => 'datetime',
		'activo' => 'bool',
		'fecha_creacion' => 'datetime',
		'rol_id' => 'int',
		'sede_id' => 'int',
		'jornada_id' => 'int',
		'ficha_id' => 'int'
	];

	protected $fillable = [
		'numero_documento',
		'hash_contrasena',
		'salt_contrasena',
		'nombre',
		'apellido',
		'email',
		'foto_url',
		'fecha_ultimo_acceso',
		'activo',
		'fecha_creacion',
		'rol_id',
		'sede_id',
		'jornada_id',
		'ficha_id'
	];

	public function ficha()
	{
		return $this->belongsTo(Ficha::class);
	}

	public function jornada()
	{
		return $this->belongsTo(Jornada::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'rol_id');
	}

	public function sede()
	{
		return $this->belongsTo(Sede::class);
	}

	public function carnet()
	{
		return $this->hasOne(Carnet::class);
	}

	public function registros_accesos()
	{
		return $this->hasMany(RegistrosAcceso::class);
	}
}
