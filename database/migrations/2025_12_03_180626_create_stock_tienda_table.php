<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_tienda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tienda_id')->constrained('tiendas')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad')->default(0);
            $table->integer('cantidad_minima')->default(5);
            $table->string('ubicacion', 50)->nullable();
            $table->timestamps(); // Esto crea created_at y updated_at automáticamente

            $table->unique(['tienda_id', 'producto_id']);
            $table->index('tienda_id');
            $table->index('producto_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_tienda');
    }
};
