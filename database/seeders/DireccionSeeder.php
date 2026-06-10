<?php

namespace Database\Seeders;

use App\Models\Direccion;
use Illuminate\Database\Seeder;

class DireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $direcciones = [
            // Direcciones para Carlos (user_id = 5)
            [
                'user_id' => 5,
                'tipo' => 'envio',
                'nombre_direccion' => 'Casa',
                'destinatario' => 'Carlos Gutiérrez',
                'direccion' => 'Calle Principal, 123',
                'ciudad' => 'Madrid',
                'provincia' => 'Madrid',
                'codigo_postal' => '28001',
                'pais' => 'España',
                'telefono' => '611223344',
                'es_principal' => true,
            ],
            [
                'user_id' => 5,
                'tipo' => 'facturacion',
                'nombre_direccion' => 'Oficina',
                'destinatario' => 'Carlos Gutiérrez',
                'direccion' => 'Calle Negocio, 45',
                'ciudad' => 'Madrid',
                'provincia' => 'Madrid',
                'codigo_postal' => '28002',
                'pais' => 'España',
                'telefono' => '611223344',
                'es_principal' => true,
            ],
            // Direcciones para Laura (user_id = 6)
            [
                'user_id' => 6,
                'tipo' => 'ambos',
                'nombre_direccion' => 'Domicilio',
                'destinatario' => 'Laura Méndez',
                'direccion' => 'Avenida Libertad, 67',
                'ciudad' => 'Barcelona',
                'provincia' => 'Barcelona',
                'codigo_postal' => '08001',
                'pais' => 'España',
                'telefono' => '622334455',
                'es_principal' => true,
            ],
            // Direcciones para Pedro (user_id = 7)
            [
                'user_id' => 7,
                'tipo' => 'envio',
                'nombre_direccion' => 'Piso',
                'destinatario' => 'Pedro Santos',
                'direccion' => 'Plaza Mayor, 89',
                'ciudad' => 'Valencia',
                'provincia' => 'Valencia',
                'codigo_postal' => '46001',
                'pais' => 'España',
                'telefono' => '633445566',
                'es_principal' => true,
            ],
        ];

        foreach ($direcciones as $direccion) {
            Direccion::create($direccion);
        }

        $this->command->info('✅ 4 direcciones creadas para clientes.');
    }
}
