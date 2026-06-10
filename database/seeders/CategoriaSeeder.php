<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Acción', 'descripcion' => 'Juegos de acción y aventura'],
            ['nombre' => 'Rol (RPG)', 'descripcion' => 'Juegos de rol'],
            ['nombre' => 'Deportes', 'descripcion' => 'Juegos deportivos'],
            ['nombre' => 'Estrategia', 'descripcion' => 'Juegos de estrategia'],
            ['nombre' => 'Indie', 'descripcion' => 'Juegos independientes'],
            ['nombre' => 'Simulación', 'descripcion' => 'Juegos de simulación'],
            ['nombre' => 'Carreras', 'descripcion' => 'Juegos de carreras'],
            ['nombre' => 'Shooter', 'descripcion' => 'Juegos de disparos'],
            ['nombre' => 'Aventura', 'descripcion' => 'Juegos de aventura'],
            ['nombre' => 'Battle Royale', 'descripcion' => 'Juegos Battle Royale'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(
                ['nombre' => $categoria['nombre']],
                array_merge($categoria, [
                    'slug' => Str::slug($categoria['nombre'])
                ])
            );
        }

        $this->command->info('✅ 10 categorías creadas/actualizadas.');
    }
}
