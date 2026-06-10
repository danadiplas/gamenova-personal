<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('slug')->unique(); // <-- QUITA: ->after('nombre')
            $table->text('descripcion')->nullable();
            $table->string('descripcion_corta', 500)->nullable();
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_rebajado', 10, 2)->nullable();
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores');
            $table->enum('plataforma', ['PC', 'PS5', 'XBOX Series X|S', 'Nintendo Switch', 'Mobile', 'Multiplataforma']);
            $table->string('desarrolladora', 150)->nullable();
            $table->string('publisher', 150)->nullable();
            $table->date('fecha_lanzamiento')->nullable();
            $table->enum('pegi', ['3', '7', '12', '16', '18'])->nullable();
            $table->string('imagen_principal')->nullable();
            $table->json('galeria')->nullable();
            $table->integer('stock_online')->default(0);
            $table->boolean('destacado')->default(false);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index('nombre');
            $table->index('slug');
            $table->index('plataforma');
            $table->index('destacado');
            $table->index(['categoria_id', 'activo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
