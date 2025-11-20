<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sesion extends Model
{
    protected $table = 'sesiones';

    protected $fillable = [
        'session_id',
        'visitante_id',
        'timestamp_inicio',
        'timestamp_ultima_actividad',
        'ip_visitante',
        'agente_navegador',
        'estado',
    ];

    protected $casts = [
        'timestamp_inicio' => 'datetime',
        'timestamp_ultima_actividad' => 'datetime',
    ];

    /**
     * Obtener todos los mensajes de esta sesión
     */
    public function mensajes(): HasMany
    {
        return $this->hasMany(Mensaje::class);
    }

    /**
     * Obtener el feedback de esta sesión
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}
