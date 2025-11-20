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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesion_id')->constrained('sesiones')->onDelete('cascade');
            $table->enum('tipo_emisor', ['visitante', 'chatbot']);
            $table->text('contenido');
            $table->timestamp('timestamp_envio');
            $table->foreignId('intencion_id')->nullable()->constrained('intenciones')->onDelete('set null');
            $table->decimal('confianza_nlp', 3, 2)->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
