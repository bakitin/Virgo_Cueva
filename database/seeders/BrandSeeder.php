<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Acira', 'Razer', 'Logitech G', 'Corsair', 'HyperX', 'Astro',
            'LG', 'ASUS ROG', 'ASUS TUF', 'ASUS ProArt', 'ASUS', 'MSI',
            'XPG', 'T3', 'Thermaltake', 'Palit', 'ASRock', 'AMD', 'Intel',
        ];

        foreach ($names as $name) {
            Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
