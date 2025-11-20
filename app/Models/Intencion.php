<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Intencion extends Model
{
    protected $table = 'intenciones';

    protected $fillable = [
        'nombre_intencion',
        'descripcion',
        'categoria_principal',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Obtener todos los mensajes con esta intención
     */
    public function mensajes(): HasMany
    {
        return $this->hasMany(Mensaje::class);
    }

    /**
     * Obtener todas las respuestas predefinidas de esta intención
     */
    public function respuestasPredefinidas(): HasMany
    {
        return $this->hasMany(RespuestaPredefinida::class);
    }

    /**
     * Obtener todas las palabras clave asociadas
     */
    public function palabrasClave(): BelongsToMany
    {
        return $this->belongsToMany(PalabraClave::class, 'intencion_palabra_clave')
            ->withPivot('peso')
            ->withTimestamps();
    }
}
