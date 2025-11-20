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
        Schema::create('eventos_tracking', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_evento', ['click_whatsapp', 'ver_producto', 'chat_iniciado', 'visita_pagina', 'clic_boton']);
            $table->foreignId('producto_id')->nullable()->constrained('productos')->onDelete('set null');
            $table->string('sesion_id')->nullable();
            $table->json('metadata')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamp('timestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_tracking');
    }
};
