<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mensaje extends Model
{
    protected $table = 'mensajes';

    protected $fillable = [
        'sesion_id',
        'tipo_emisor',
        'contenido',
        'timestamp_envio',
        'intencion_id',
        'confianza_nlp',
        'metadata',
    ];

    protected $casts = [
        'timestamp_envio' => 'datetime',
        'confianza_nlp' => 'decimal:2',
        'metadata' => 'array',
    ];

    /**
     * Obtener la sesión del mensaje
     */
    public function sesion(): BelongsTo
    {
        return $this->belongsTo(Sesion::class);
    }

    /**
     * Obtener la intención del mensaje
     */
    public function intencion(): BelongsTo
    {
        return $this->belongsTo(Intencion::class);
    }

    /**
     * Obtener el feedback del mensaje
     */
    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class);
    }
}
