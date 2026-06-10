<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id(); // <-- id, no proveedorID
            $table->foreignId('user_id')->nullable()->unique()->constrained('users')->onDelete('set null'); // <-- user_id
            $table->string('nombre_empresa', 200);
            $table->string('contacto', 150)->nullable();
            $table->string('telefono', 20);
            $table->string('email')->unique();
            $table->string('direccion', 255);
            $table->string('ciudad', 100);
            $table->string('pais', 100)->default('España');
            $table->string('cif_nif', 50)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index('nombre_empresa');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
