<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad')->unsigned()->default(1);
            // $table->decimal('precio', 8, 2)->nullable();
            // $table->string('metodo_entrega')->nullable();
            $table->foreignId('tienda_recogida_id')->nullable()->constrained('tiendas')->nullOnDelete();
            $table->timestamps();

            // $table->unique(['user_id', 'producto_id']);

            $table->index('user_id');
            $table->index('producto_id');
        });
    }
};
