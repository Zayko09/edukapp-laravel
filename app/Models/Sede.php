<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sede
 * 
 * @property int $sede_id
 * @property string $nombre_sede
 * @property string|null $ciudad
 * @property string|null $departamento
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $logo_url
 * 
 * @property Collection|Ficha[] $fichas
 * @property Collection|RegistrosAcceso[] $registros_accesos
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Sede extends Model
{
	protected $table = 'sedes';
	protected $primaryKey = 'sede_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'sede_id' => 'int'
	];

	protected $fillable = [
		'nombre_sede',
		'ciudad',
		'departamento',
		'direccion',
		'telefono',
		'logo_url'
	];

	public function fichas()
	{
		return $this->hasMany(Ficha::class);
	}

	public function registros_accesos()
	{
		return $this->hasMany(RegistrosAcceso::class);
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class);
	}
}
