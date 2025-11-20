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
        Schema::create('resenas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->nullable()->constrained('productos')->onDelete('cascade');
            $table->string('nombre_cliente', 100);
            $table->string('email_cliente')->nullable();
            $table->integer('calificacion');
            $table->text('comentario');
            $table->boolean('aprobado')->default(false);
            $table->boolean('destacado')->default(false);
            $table->timestamp('timestamp_publicacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
