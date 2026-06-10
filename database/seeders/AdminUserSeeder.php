<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Andrea',
                'apellidos' => 'Gómez',
                'email' => 'andrea.admin@gamenova.com',
                'password' => Hash::make('123'),
                'rol' => 'admin',
                'fecha_nacimiento' => '1990-05-15',
                'telefono' => '612345678',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Adrián',
                'apellidos' => 'Martínez',
                'email' => 'adrian.admin@gamenova.com',
                'password' => Hash::make('123'),
                'rol' => 'admin',
                'fecha_nacimiento' => '1988-11-22',
                'telefono' => '623456789',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dana',
                'apellidos' => 'Rodríguez',
                'email' => 'dana.admin@gamenova.com',
                'password' => Hash::make('123'),
                'rol' => 'admin',
                'fecha_nacimiento' => '1992-03-10',
                'telefono' => '634567890',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Super Admin',
                'apellidos' => 'Gamenova',
                'email' => 'admin@gamenova.com',
                'password' => Hash::make('123'),
                'rol' => 'admin',
                'fecha_nacimiento' => '1985-01-01',
                'telefono' => '600000000',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']], // Buscar por email
                array_merge($admin, ['activo' => true]) // Datos a crear/actualizar
            );
        }

        $this->command->info('✅ Administradores actualizados/creados con éxito.');
        $this->command->info('📧 Emails: andrea.admin@gamenova.com, adrian.admin@gamenova.com, dana.admin@gamenova.com, admin@gamenova.com');
        $this->command->info('🔑 Contraseña para todos: 123');
        $this->command->info('👥 Total administradores: ' . User::where('rol', 'admin')->count());
    }
}
