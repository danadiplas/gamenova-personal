<?php

namespace Database\Seeders;

use App\Models\Tienda;
use Illuminate\Database\Seeder;

class TiendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiendas = [
            [
                'nombre' => 'Gamenova Central',
                'direccion' => 'Calle Gran Vía, 123',
                'ciudad' => 'Madrid',
                'provincia' => 'Madrid',
                'codigo_postal' => '28013',
                'telefono' => '910000001',
                'email' => 'central@gamenova.com',
                'horario' => 'L-V: 10:00-22:00, S-D: 11:00-23:00',
                'latitud' => 40.416775,
                'longitud' => -3.703790,
                'activa' => true,
            ],
            [
                'nombre' => 'Gamenova Barcelona',
                'direccion' => 'Avenida Diagonal, 456',
                'ciudad' => 'Barcelona',
                'provincia' => 'Barcelona',
                'codigo_postal' => '08008',
                'telefono' => '930000002',
                'email' => 'barcelona@gamenova.com',
                'horario' => 'L-V: 10:00-21:00, S: 10:00-22:00',
                'latitud' => 41.390205,
                'longitud' => 2.154007,
                'activa' => true,
            ],
            [
                'nombre' => 'Gamenova Valencia',
                'direccion' => 'Calle Colón, 78',
                'ciudad' => 'Valencia',
                'provincia' => 'Valencia',
                'codigo_postal' => '46004',
                'telefono' => '960000003',
                'email' => 'valencia@gamenova.com',
                'horario' => 'L-S: 10:00-21:00',
                'latitud' => 39.469907,
                'longitud' => -0.376288,
                'activa' => true,
            ],
        ];

        foreach ($tiendas as $tienda) {
            Tienda::create($tienda);
        }

        $this->command->info('✅ 3 tiendas creadas.');
    }
}
