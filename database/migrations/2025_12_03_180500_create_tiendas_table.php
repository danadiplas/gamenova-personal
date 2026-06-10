<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tiendas', function (Blueprint $table) {
            $table->id(); // <-- id, no tiendaID
            $table->string('nombre', 150);
            $table->string('direccion', 255);
            $table->string('ciudad', 100);
            $table->string('provincia', 100);
            $table->string('codigo_postal', 10)->nullable();
            $table->string('telefono', 20);
            $table->string('email')->nullable();
            $table->text('horario')->nullable();
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->boolean('activa')->default(true);
            $table->timestamps();

            $table->index(['ciudad', 'activa']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tiendas');
    }
};
