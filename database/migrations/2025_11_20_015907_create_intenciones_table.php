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
        Schema::create('intenciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_intencion', 100)->unique();
            $table->text('descripcion')->nullable();
            $table->enum('categoria_principal', ['ventas', 'logistica', 'general', 'soporte']);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intenciones');
    }
};
