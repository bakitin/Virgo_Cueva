<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Teclados', 'slug' => 'teclados', 'description' => 'Teclados mecánicos y de membrana para gaming.'],
            ['name' => 'Mouses', 'slug' => 'mouses', 'description' => 'Mouses gamer inalámbricos y con cable.'],
            ['name' => 'Audio', 'slug' => 'audio', 'description' => 'Audífonos y headsets gamer.'],
            ['name' => 'Monitores', 'slug' => 'monitores', 'description' => 'Monitores gamer y profesionales.'],
            ['name' => 'Sillas', 'slug' => 'sillas', 'description' => 'Sillas gamer y de oficina.'],
            ['name' => 'Gabinetes', 'slug' => 'gabinetes', 'description' => 'Gabinetes y chasis para armar tu PC.'],
            ['name' => 'Tarjetas de video', 'slug' => 'gpu', 'description' => 'Tarjetas gráficas NVIDIA y AMD.'],
            ['name' => 'Procesadores', 'slug' => 'procesadores', 'description' => 'Procesadores Intel y AMD.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
