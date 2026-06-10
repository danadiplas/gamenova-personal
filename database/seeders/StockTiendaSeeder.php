<?php

namespace Database\Seeders;

use App\Models\StockTienda;
use Illuminate\Database\Seeder;

class StockTiendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $created = 0;
        $updated = 0;

        // 3 tiendas x 8 productos
        for ($tienda_id = 1; $tienda_id <= 3; $tienda_id++) {
            for ($producto_id = 1; $producto_id <= 8; $producto_id++) {
                // Usar updateOrCreate para evitar errores de duplicados
                StockTienda::updateOrCreate(
                    [
                        'tienda_id' => $tienda_id,
                        'producto_id' => $producto_id,
                    ],
                    [
                        'cantidad' => rand(5, 30),
                        'cantidad_minima' => 5,
                        'ubicacion' => 'Estantería ' . chr(64 + $producto_id), // A, B, C, etc.
                    ]
                );

                // Contar lo que se hizo
                $created++; // updateOrCreate siempre "crea" o actualiza
            }
        }

        $this->command->info('✅ Stock por tienda creado/actualizado (3 tiendas x 8 productos).');
    }
}
