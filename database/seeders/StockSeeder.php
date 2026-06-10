<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usar updateOrCreate para evitar errores de duplicados
        for ($i = 1; $i <= 8; $i++) {
            Stock::updateOrCreate(
                ['producto_id' => $i], // Condición de búsqueda
                [
                    'cantidad' => rand(50, 200),
                    'cantidad_minima' => 5,
                ]
            );
        }

        $this->command->info('✅ Stock general creado/actualizado para 8 productos.');
    }
}
