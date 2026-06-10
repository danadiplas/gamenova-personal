<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'FIFA 25',
                'descripcion' => 'El simulador de fútbol más realista',
                'descripcion_corta' => 'FIFA 25 - Edición Estándar',
                'precio' => 69.99,
                'precio_rebajado' => 59.99,
                'categoria_id' => 3, // Deportes
                'proveedor_id' => 1, // EA
                'plataforma' => 'PS5',
                'desarrolladora' => 'EA Sports',
                'publisher' => 'Electronic Arts',
                'fecha_lanzamiento' => '2025-09-27',
                'pegi' => '3',
                'imagen_principal' => 'fifa25.jpg',
                'stock_online' => 150,
                'destacado' => true,
                'activo' => true,
            ],
            [
                'nombre' => 'The Legend of Zelda: Echoes of Wisdom',
                'descripcion' => 'Nueva aventura de Zelda',
                'descripcion_corta' => 'Zelda para Nintendo Switch',
                'precio' => 59.99,
                'precio_rebajado' => null,
                'categoria_id' => 2, // RPG
                'proveedor_id' => 3, // Nintendo
                'plataforma' => 'Nintendo Switch',
                'desarrolladora' => 'Nintendo EPD',
                'publisher' => 'Nintendo',
                'fecha_lanzamiento' => '2025-05-23',
                'pegi' => '12',
                'imagen_principal' => 'TheLegendofZeldaEchoesOfWisdom.jpg',
                'stock_online' => 80,
                'destacado' => true,
                'activo' => true,
            ],
            [
                'nombre' => 'Call of Duty: Modern Warfare III',
                'descripcion' => 'FPS multijugador intenso',
                'descripcion_corta' => 'Call of Duty MW3',
                'precio' => 79.99,
                'precio_rebajado' => 69.99,
                'categoria_id' => 8, // Shooter
                'proveedor_id' => 4, // Sony
                'plataforma' => 'XBOX Series X|S',
                'desarrolladora' => 'Infinity Ward',
                'publisher' => 'Activision',
                'fecha_lanzamiento' => '2024-11-10',
                'pegi' => '18',
                'imagen_principal' => 'CallOfDutyModernWarfare.jpg',
                'stock_online' => 200,
                'destacado' => false,
                'activo' => true,
            ],
            [
                'nombre' => 'Grand Theft Auto VI',
                'descripcion' => 'Aventura de mundo abierto',
                'descripcion_corta' => 'GTA VI - Leonida',
                'precio' => 89.99,
                'precio_rebajado' => null,
                'categoria_id' => 1, // Acción
                'proveedor_id' => 2, // Ubisoft
                'plataforma' => 'PS5',
                'desarrolladora' => 'Rockstar Games',
                'publisher' => 'Rockstar',
                'fecha_lanzamiento' => '2025-10-26',
                'pegi' => '18',
                'imagen_principal' => 'grandtheftautovi.jpg',
                'stock_online' => 300,
                'destacado' => true,
                'activo' => true,
            ],
            [
                'nombre' => 'Minecraft Legends',
                'descripcion' => 'Estrategia en el mundo de Minecraft',
                'descripcion_corta' => 'Minecraft de estrategia',
                'precio' => 39.99,
                'precio_rebajado' => 29.99,
                'categoria_id' => 4, // Estrategia
                'proveedor_id' => 5, // Microsoft
                'plataforma' => 'Multiplataforma',
                'desarrolladora' => 'Mojang Studios',
                'publisher' => 'Microsoft',
                'fecha_lanzamiento' => '2023-04-18',
                'pegi' => '7',
                'imagen_principal' => 'MinecraftLegends.jpg',
                'stock_online' => 120,
                'destacado' => false,
                'activo' => true,
            ],
            [
                'nombre' => 'Assassins Creed Shadows',
                'descripcion' => 'Nueva entrega de Assassins Creed',
                'descripcion_corta' => 'AC Shadows - Japón feudal',
                'precio' => 69.99,
                'precio_rebajado' => 59.99,
                'categoria_id' => 1, // Acción
                'proveedor_id' => 2, // Ubisoft
                'plataforma' => 'PC',
                'desarrolladora' => 'Ubisoft Quebec',
                'publisher' => 'Ubisoft',
                'fecha_lanzamiento' => '2024-11-15',
                'pegi' => '16',
                'imagen_principal' => 'AssassinsCreedShadows.jpg',
                'stock_online' => 90,
                'destacado' => true,
                'activo' => true,
            ],
            [
                'nombre' => 'Forza Horizon 6',
                'descripcion' => 'Carreras en mundo abierto',
                'descripcion_corta' => 'Forza Horizon en Japón',
                'precio' => 79.99,
                'precio_rebajado' => 69.99,
                'categoria_id' => 7, // Carreras
                'proveedor_id' => 5, // Microsoft
                'plataforma' => 'XBOX Series X|S',
                'desarrolladora' => 'Playground Games',
                'publisher' => 'Microsoft',
                'fecha_lanzamiento' => '2025-09-05',
                'pegi' => '3',
                'imagen_principal' => 'ForzaHorizon6.jpg',
                'stock_online' => 110,
                'destacado' => false,
                'activo' => true,
            ],
            [
                'nombre' => 'Stray 2',
                'descripcion' => 'Aventura de un gato en ciudad cyberpunk',
                'descripcion_corta' => 'Juega como un gato',
                'precio' => 29.99,
                'precio_rebajado' => 24.99,
                'categoria_id' => 5, // Indie
                'proveedor_id' => 4, // Sony
                'plataforma' => 'PS5',
                'desarrolladora' => 'BlueTwelve Studio',
                'publisher' => 'Annapurna Interactive',
                'fecha_lanzamiento' => '2025-06-15',
                'pegi' => '7',
                'imagen_principal' => 'Stray2.jpg',
                'stock_online' => 70,
                'destacado' => true,
                'activo' => true,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::updateOrCreate(
                ['nombre' => $producto['nombre']], // Buscar por nombre
                array_merge($producto, [
                    'slug' => Str::slug($producto['nombre']) // Agregar slug
                ])
            );
        }

        $this->command->info('✅ 8 productos creados/actualizados.');
    }
}
