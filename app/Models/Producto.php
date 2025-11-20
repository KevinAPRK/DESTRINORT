<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion_corta',
        'descripcion_larga',
        'precio',
        'precio_oferta',
        'marca_id',
        'categoria_id',
        'imagen_principal',
        'presentacion',
        'stock',
        'disponible',
        'destacado',
        'activo',
        'orden',
        'vistas',
        'seo_titulo',
        'seo_descripcion',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'precio_oferta' => 'decimal:2',
        'stock' => 'integer',
        'disponible' => 'boolean',
        'destacado' => 'boolean',
        'activo' => 'boolean',
        'orden' => 'integer',
        'vistas' => 'integer',
    ];

    /**
     * Obtener la marca del producto
     */
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    /**
     * Obtener la categoría del producto
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Obtener todas las imágenes del producto
     */
    public function imagenes(): HasMany
    {
        return $this->hasMany(ProductoImagen::class);
    }

    /**
     * Obtener todas las reseñas del producto
     */
    public function resenas(): HasMany
    {
        return $this->hasMany(Resena::class);
    }

    /**
     * Obtener eventos de tracking del producto
     */
    public function eventosTracking(): HasMany
    {
        return $this->hasMany(EventoTracking::class);
    }
}
