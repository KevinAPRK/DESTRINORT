<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'mensaje_id',
        'sesion_id',
        'valoracion',
        'comentarios',
        'timestamp_feedback',
    ];

    protected $casts = [
        'valoracion' => 'integer',
        'timestamp_feedback' => 'datetime',
    ];

    /**
     * Obtener el mensaje del feedback
     */
    public function mensaje(): BelongsTo
    {
        return $this->belongsTo(Mensaje::class);
    }

    /**
     * Obtener la sesión del feedback
     */
    public function sesion(): BelongsTo
    {
        return $this->belongsTo(Sesion::class);
    }
}
