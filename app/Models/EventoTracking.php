<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventoTracking extends Model
{
    protected $table = 'eventos_tracking';

    public $timestamps = false;

    protected $fillable = [
        'tipo_evento',
        'producto_id',
        'sesion_id',
        'metadata',
        'ip',
        'timestamp',
    ];

    protected $casts = [
        'metadata' => 'array',
        'timestamp' => 'datetime',
    ];

    /**
     * Obtener el producto del evento
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
