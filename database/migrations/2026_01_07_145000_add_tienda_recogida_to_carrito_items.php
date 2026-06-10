<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carrito_items', function (Blueprint $table) {
            if (!Schema::hasColumn('carrito_items', 'tienda_recogida_id')) {
                $table->foreignId('tienda_recogida_id')->nullable()->after('metodo_entrega')
                    ->constrained('tiendas')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('carrito_items', function (Blueprint $table) {
            // Verificar si existe antes de eliminar
            if (Schema::hasColumn('carrito_items', 'tienda_recogida_id')) {
                $table->dropForeign(['tienda_recogida_id']);
                $table->dropColumn('tienda_recogida_id');
            }
        });
    }
};
