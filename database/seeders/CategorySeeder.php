<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Teclados', 'slug' => 'teclados', 'description' => 'Teclados mecánicos y de membrana para gaming.', 'image' => '/images/teclados/ACIRA_1.webp'],
            ['name' => 'Mouses', 'slug' => 'mouses', 'description' => 'Mouses gamer inalámbricos y con cable.', 'image' => '/images/mouses/GAMER_SABRE_V2_1.webp'],
            ['name' => 'Audio', 'slug' => 'audio', 'description' => 'Audífonos y headsets gamer.', 'image' => '/images/audio/A20_X_BLACK_1.webp'],
            ['name' => 'Monitores', 'slug' => 'monitores', 'description' => 'Monitores gamer y profesionales.', 'image' => '/images/monitores/27G523B-B_1.png'],
            ['name' => 'Sillas', 'slug' => 'sillas', 'description' => 'Sillas gamer y de oficina.', 'image' => '/images/sillas/ISKUR_V2_X_NEEWGEN_QUARTZ_2.png'],
            ['name' => 'Gabinetes', 'slug' => 'gabinetes', 'description' => 'Gabinetes y chasis para armar tu PC.', 'image' => '/images/gabinetes/380TG_BLACK.webp'],
            ['name' => 'Tarjetas de video', 'slug' => 'gpu', 'description' => 'Tarjetas gráficas NVIDIA y AMD.', 'image' => '/images/gpu/PALIT_5070_WHITE_12G_1.png'],
            ['name' => 'Procesadores', 'slug' => 'procesadores', 'description' => 'Procesadores Intel y AMD.', 'image' => '/images/procesadores/PROCESADOR_5_7600X3D.webp'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
