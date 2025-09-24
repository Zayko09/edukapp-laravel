<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    protected $table = 'jornadas';
    protected $primaryKey = 'jornada_id';

    protected $fillable = [
        'nombre_jornada',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Método para verificar si el nombre es único
    public static function isNameUnique($nombre, $excludeId = null)
    {
        $query = static::where('nombre_jornada', $nombre);
        
        if ($excludeId) {
            $query->where('jornada_id', '!=', $excludeId);
        }
        
        return !$query->exists();
    }
}
