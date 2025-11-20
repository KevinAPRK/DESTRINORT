<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resena extends Model
{
    protected $table = 'resenas';

    protected $fillable = [
        'producto_id',
        'nombre_cliente',
        'email_cliente',
        'calificacion',
        'comentario',
        'aprobado',
        'destacado',
        'timestamp_publicacion',
    ];

    protected $casts = [
        'calificacion' => 'integer',
        'aprobado' => 'boolean',
        'destacado' => 'boolean',
        'timestamp_publicacion' => 'datetime',
    ];

    /**
     * Obtener el producto de la reseña
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
