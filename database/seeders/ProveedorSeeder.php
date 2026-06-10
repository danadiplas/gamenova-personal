<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedores = [
            [
                'nombre_empresa' => 'Electronic Arts',
                'contacto' => 'Juan Pérez',
                'telefono' => '915551111',
                'email' => 'ventas@ea.com',
                'direccion' => 'Calle Business, 1',
                'ciudad' => 'Madrid',
                'pais' => 'España',
                'cif_nif' => 'A12345678',
                'activo' => true,
            ],
            [
                'nombre_empresa' => 'Ubisoft España',
                'contacto' => 'María López',
                'telefono' => '915552222',
                'email' => 'contact@ubisoft.es',
                'direccion' => 'Calle Games, 23',
                'ciudad' => 'Barcelona',
                'pais' => 'España',
                'cif_nif' => 'B87654321',
                'activo' => true,
            ],
            [
                'nombre_empresa' => 'Nintendo Iberia',
                'contacto' => 'Carlos Ruiz',
                'telefono' => '915553333',
                'email' => 'info@nintendo.es',
                'direccion' => 'Avenida Nintendo, 45',
                'ciudad' => 'Madrid',
                'pais' => 'España',
                'cif_nif' => 'C11223344',
                'activo' => true,
            ],
            [
                'nombre_empresa' => 'Sony Interactive',
                'contacto' => 'Ana García',
                'telefono' => '915554444',
                'email' => 'sony@playstation.com',
                'direccion' => 'Plaza Sony, 67',
                'ciudad' => 'Madrid',
                'pais' => 'España',
                'cif_nif' => 'D55667788',
                'activo' => true,
            ],
            [
                'nombre_empresa' => 'Microsoft Gaming',
                'contacto' => 'David Fernández',
                'telefono' => '915555555',
                'email' => 'xbox@microsoft.com',
                'direccion' => 'Calle Microsoft, 89',
                'ciudad' => 'Madrid',
                'pais' => 'España',
                'cif_nif' => 'E99887766',
                'activo' => true,
            ],
        ];

        foreach ($proveedores as $proveedor) {
            Proveedor::updateOrCreate(
                ['email' => $proveedor['email']], // Buscar por email único
                $proveedor // Datos a actualizar/crear
            );
        }

        $this->command->info('✅ 5 proveedores creados/actualizados.');
    }
}
