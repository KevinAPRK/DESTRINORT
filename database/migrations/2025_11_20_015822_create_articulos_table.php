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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->string('slug', 200)->unique();
            $table->text('extracto')->nullable();
            $table->text('contenido');
            $table->string('imagen_portada')->nullable();
            $table->foreignId('autor_id')->constrained('users')->onDelete('cascade');
            $table->boolean('publicado')->default(false);
            $table->timestamp('fecha_publicacion')->nullable();
            $table->integer('vistas')->default(0);
            $table->string('seo_titulo', 200)->nullable();
            $table->string('seo_descripcion', 300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
