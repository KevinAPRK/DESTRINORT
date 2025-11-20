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
        Schema::create('respuestas_predefinidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intencion_id')->constrained('intenciones')->onDelete('cascade');
            $table->text('contenido');
            $table->json('variables')->nullable();
            $table->boolean('activo')->default(true);
            $table->integer('prioridad')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_predefinidas');
    }
};
