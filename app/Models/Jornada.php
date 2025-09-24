<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // Relaciones
    public function fichas(): HasMany
    {
        return $this->hasMany(Ficha::class, 'jornada_id', 'jornada_id');
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'jornada_id', 'jornada_id');
    }

    // Scopes
    public function scopeSearch($query, $search)
    {
        return $query->where('nombre_jornada', 'LIKE', "%{$search}%");
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('nombre_jornada');
    }

    // Métodos
    public function hasFichas(): bool
    {
        return $this->fichas()->exists();
    }

    public static function isNameUnique($nombre, $excludeId = null): bool
    {
        $query = static::where('nombre_jornada', $nombre);
        
        if ($excludeId) {
            $query->where('jornada_id', '!=', $excludeId);
        }
        
        return !$query->exists();
    }
}
