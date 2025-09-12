<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $rol_id
 * @property string $nombre_rol
 * 
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	protected $primaryKey = 'rol_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'rol_id' => 'int'
	];

	protected $fillable = [
		'nombre_rol'
	];

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'rol_id');
	}
}
