<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = [
            [
                'name' => 'Carlos',
                'apellidos' => 'Gutiérrez',
                'email' => 'carlos@cliente.com',
                'password' => Hash::make('cliente123'),
                'rol' => 'cliente',
                'fecha_nacimiento' => '1995-08-14',
                'telefono' => '611223344',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Laura',
                'apellidos' => 'Méndez',
                'email' => 'laura@cliente.com',
                'password' => Hash::make('cliente123'),
                'rol' => 'cliente',
                'fecha_nacimiento' => '1998-03-25',
                'telefono' => '622334455',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Pedro',
                'apellidos' => 'Santos',
                'email' => 'pedro@cliente.com',
                'password' => Hash::make('cliente123'),
                'rol' => 'cliente',
                'fecha_nacimiento' => '1990-11-03',
                'telefono' => '633445566',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Proveedor Ejemplo',
                'apellidos' => 'S.L.',
                'email' => 'proveedor@ejemplo.com',
                'password' => Hash::make('proveedor123'),
                'rol' => 'proveedor',
                'fecha_nacimiento' => '1980-01-01',
                'telefono' => '900123456',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($clientes as $cliente) {
            User::updateOrCreate(
                ['email' => $cliente['email']], // Buscar por email
                array_merge($cliente, ['activo' => true]) // Datos a crear/actualizar
            );
        }

        $this->command->info('✅ Usuarios (3 clientes + 1 proveedor) creados/actualizados.');
    }
}
