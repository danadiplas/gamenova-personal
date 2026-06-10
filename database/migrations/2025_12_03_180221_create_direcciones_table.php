<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id(); // <-- id, no direccionID
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // <-- user_id
            $table->enum('tipo', ['envio', 'facturacion', 'ambos']);
            $table->string('nombre_direccion', 100)->nullable();
            $table->string('destinatario', 150);
            $table->string('direccion', 255);
            $table->string('ciudad', 100);
            $table->string('provincia', 100);
            $table->string('codigo_postal', 10);
            $table->string('pais', 100)->default('España');
            $table->string('telefono', 20);
            $table->boolean('es_principal')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'tipo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
