<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('slug')->unique(); // <-- AGREGA ESTA LÍNEA
            $table->text('descripcion')->nullable();
            $table->foreignId('categoria_padre_id')->nullable()->constrained('categorias')->onDelete('set null');
            $table->string('imagen')->nullable();
            $table->boolean('activa')->default(true);
            $table->timestamps();

            $table->index('nombre');
            $table->index('slug'); // <-- Índice para slug
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
