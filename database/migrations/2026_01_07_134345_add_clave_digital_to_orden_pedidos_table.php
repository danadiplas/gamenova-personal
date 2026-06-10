<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orden_pedido', function (Blueprint $table) {
            if (!Schema::hasColumn('orden_pedido', 'clave_digital')) {
                $table->string('clave_digital')->nullable()->after('subtotal');
            }

            if (!Schema::hasColumn('orden_pedido', 'clave_generada_en')) {
                $table->timestamp('clave_generada_en')->nullable()->after('clave_digital');
            }

            if (!Schema::hasColumn('orden_pedido', 'metodo_entrega')) {
                $table->string('metodo_entrega')->default('domicilio')->after('clave_generada_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orden_pedido', function (Blueprint $table) {
            // Verificar antes de eliminar
            if (Schema::hasColumn('orden_pedido', 'clave_digital')) {
                $table->dropColumn('clave_digital');
            }

            if (Schema::hasColumn('orden_pedido', 'clave_generada_en')) {
                $table->dropColumn('clave_generada_en');
            }

            if (Schema::hasColumn('orden_pedido', 'metodo_entrega')) {
                $table->dropColumn('metodo_entrega');
            }
        });
    }
};
