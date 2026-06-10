<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            UserSeeder::class,
            CategoriaSeeder::class,
            TiendaSeeder::class,
            ProveedorSeeder::class,
            ProductoSeeder::class,
            StockSeeder::class,
            StockTiendaSeeder::class,
            DireccionSeeder::class,
            PedidoSeeder::class,
        ]);

        $this->command->info('🎉 Base de datos sembrada.');
    }
}
