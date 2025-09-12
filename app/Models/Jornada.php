<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jornada
 * 
 * @property int $jornada_id
 * @property string $nombre_jornada
 * 
 * @property Collection|Ficha[] $fichas
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Jornada extends Model
{
	protected $table = 'jornadas';
	protected $primaryKey = 'jornada_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'jornada_id' => 'int'
	];

	protected $fillable = [
		'nombre_jornada'
	];

	public function fichas()
	{
		return $this->hasMany(Ficha::class);
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class);
	}
}
