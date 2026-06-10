<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('numero_pedido', 50)->unique();
            $table->foreignId('direccion_envio_id')->constrained('direcciones');
            $table->foreignId('direccion_facturacion_id')->constrained('direcciones');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('envio', 8, 2)->default(0);
            $table->decimal('iva', 10, 2);
            $table->decimal('total', 10, 2);
            $table->enum('estado', ['pendiente', 'confirmado', 'procesando', 'enviado', 'entregado', 'cancelado'])->default('pendiente');
            $table->enum('metodo_pago', ['tarjeta', 'paypal', 'transferencia', 'contra_reembolso'])->nullable();
            $table->text('notas')->nullable();
            $table->timestamp('fecha_pedido')->useCurrent();
            $table->timestamp('fecha_envio')->nullable();
            $table->timestamp('fecha_entrega')->nullable();
            $table->string('tracking_number', 100)->nullable();
            $table->timestamps(); // <-- AGREGA ESTA LÍNEA

            $table->index(['user_id', 'fecha_pedido']);
            $table->index('numero_pedido');
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
