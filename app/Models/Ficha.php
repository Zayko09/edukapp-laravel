<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ficha
 * 
 * @property int $ficha_id
 * @property string $nombre_ficha
 * @property string|null $descripcion
 * @property int $sede_id
 * @property int $jornada_id
 * 
 * @property Jornada $jornada
 * @property Sede $sede
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Ficha extends Model
{
	protected $table = 'fichas';
	protected $primaryKey = 'ficha_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ficha_id' => 'int',
		'sede_id' => 'int',
		'jornada_id' => 'int'
	];

	protected $fillable = [
		'nombre_ficha',
		'descripcion',
		'sede_id',
		'jornada_id'
	];

	public function jornada()
	{
		return $this->belongsTo(Jornada::class);
	}

	public function sede()
	{
		return $this->belongsTo(Sede::class);
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class);
	}
}
