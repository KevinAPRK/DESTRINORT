<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sesiones', function (Blueprint $table) {
            $table->id();
            $table->uuid('session_id')->unique();
            $table->string('visitante_id')->nullable();
            $table->timestamp('timestamp_inicio');
            $table->timestamp('timestamp_ultima_actividad');
            $table->string('ip_visitante', 45)->nullable();
            $table->text('agente_navegador')->nullable();
            $table->enum('estado', ['abierta', 'cerrada', 'inactiva'])->default('abierta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesiones');
    }
};
