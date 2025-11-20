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
        Schema::create('intencion_palabra_clave', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intencion_id')->constrained('intenciones')->onDelete('cascade');
            $table->foreignId('palabra_clave_id')->constrained('palabras_clave')->onDelete('cascade');
            $table->decimal('peso', 3, 2)->default(1.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intencion_palabra_clave');
    }
};
