<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RespuestaPredefinida extends Model
{
    protected $table = 'respuestas_predefinidas';

    protected $fillable = [
        'intencion_id',
        'contenido',
        'variables',
        'activo',
        'prioridad',
    ];

    protected $casts = [
        'variables' => 'array',
        'activo' => 'boolean',
        'prioridad' => 'integer',
    ];

    /**
     * Obtener la intención de esta respuesta
     */
    public function intencion(): BelongsTo
    {
        return $this->belongsTo(Intencion::class);
    }
}
