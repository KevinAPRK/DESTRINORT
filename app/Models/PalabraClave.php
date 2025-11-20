<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PalabraClave extends Model
{
    protected $table = 'palabras_clave';

    protected $fillable = [
        'palabra',
        'tipo',
    ];

    /**
     * Obtener todas las intenciones asociadas
     */
    public function intenciones(): BelongsToMany
    {
        return $this->belongsToMany(Intencion::class, 'intencion_palabra_clave')
            ->withPivot('peso')
            ->withTimestamps();
    }
}
