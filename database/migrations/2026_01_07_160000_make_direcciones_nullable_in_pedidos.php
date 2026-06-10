<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Hacer nullable las direcciones ya que productos digitales no las necesitan
            $table->unsignedBigInteger('direccion_envio_id')->nullable()->change();
            $table->unsignedBigInteger('direccion_facturacion_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->unsignedBigInteger('direccion_envio_id')->nullable(false)->change();
            $table->unsignedBigInteger('direccion_facturacion_id')->nullable(false)->change();
        });
    }
};
