<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Articulo extends Model
{
    protected $table = 'articulos';

    protected $fillable = [
        'titulo',
        'slug',
        'extracto',
        'contenido',
        'imagen_portada',
        'autor_id',
        'publicado',
        'fecha_publicacion',
        'vistas',
        'seo_titulo',
        'seo_descripcion',
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'fecha_publicacion' => 'datetime',
        'vistas' => 'integer',
    ];

    /**
     * Obtener el autor del artículo
     */
    public function autor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'autor_id');
    }
}
