<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSpec;
use Illuminate\Database\Seeder;

class ProductSpecSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::pluck('id', 'slug');

        foreach ($this->specs() as $slug => $specs) {
            foreach ($specs as $order => $value) {
                ProductSpec::create([
                    'product_id' => $products[$slug],
                    'name' => 'Especificación',
                    'value' => $value,
                    'sort_order' => $order + 1,
                ]);
            }
        }
    }

    /**
     * Specs por producto, transcritas de resources/js/products.js
     */
    public function specs(): array
    {
        return [
            'acira' => ['Switches mecánicos', 'Retroiluminación RGB por tecla', 'Formato full size (104 teclas)', 'Conexión USB con cable'],
            'blackwidow-v4-tkl' => ['Switches mecánicos Razer (clicky/verde)', 'Formato TKL (sin teclado numérico)', 'Chroma RGB', 'Reposamuñecas magnético incluido', 'Teclas multimedia dedicadas'],
            'blackwidow-v4-x-pikachu' => ['Switches mecánicos Razer verdes (clicky)', '6 teclas macro dedicadas', 'Chroma RGB', 'Keycaps doubleshot ABS', 'Edición coleccionable Pokémon'],
            'ornata-v3' => ['Switches mecha-membrana', 'Perfil bajo (low-profile)', '10 zonas de Chroma RGB', 'Resistente a salpicaduras', 'Reposamuñecas magnético incluido'],
            'g512-x' => ['Sensor TMR (analógico + mecánico)', 'Actuación ajustable de 0.1mm a 4.0mm', 'Rapid Trigger', 'Polling rate de 8000Hz', 'Formato 75%'],

            'sabre-v2-pro' => ['Sensor óptico 33.000 DPI', 'Peso 36g', 'Inalámbrico 2.4GHz', 'Hasta 70 horas de batería', 'Switches mecánicos (100M clics)'],
            'pulsefire-haste-2' => ['Diseño ultraligero perforado', 'Inalámbrico 2.4GHz', 'Batería de larga duración', 'Pies de PTFE de fábrica'],
            'g305-lightspeed' => ['Sensor HERO 12K DPI', 'Tecnología LIGHTSPEED', 'Hasta 250 horas de batería (1 pila AA)', '6 botones programables'],
            'g502-x-lightspeed' => ['Sensor HERO 25K DPI', '13 botones programables', 'Switches híbridos LIGHTFORCE', 'Compatible con carga inalámbrica POWERPLAY', 'Peso 102g'],
            'viper-v3-hyperspeed' => ['Sensor Focus Pro 30K DPI', 'Peso 59g (82g con pila)', 'Hasta 280 horas de batería', '8 botones programables', 'Switches mecánicos (60M clics)'],

            'astro-a20-x' => ['Drivers de 40mm', 'Conexión dual 2.4GHz + Bluetooth 5.3', 'Hasta 90 horas de batería', 'Micrófono desmontable', 'RGB personalizable'],
            'barracuda-x-quartz' => ['Drivers Razer TriForce de 40mm', 'Conexión 2.4GHz y Bluetooth', 'Hasta 20 horas de batería', 'Micrófono desmontable HyperClear'],
            'blackshark-v3-ps' => ['Drivers TriForce Titanium 50mm Gen-2', 'Latencia inalámbrica desde 10ms', 'Micrófono HyperClear Super WideBand', 'Conexión 2.4GHz y Bluetooth'],
            'hs80-wireless' => ['Dolby Atmos para auriculares', 'Micrófono broadcast desmontable', 'Hasta 20 horas de batería', 'Orejeras de memory foam', 'RGB en los ear cups'],
            'kraken-kitty-v3-x' => ['Drivers TriForce de 40mm', 'Sonido envolvente 7.1', 'Orejas de gato con RGB', 'Micrófono cardioide', 'Peso 270g'],

            'lg-ultragear-27g523b' => ['27" Full HD (1920x1080) IPS', '200Hz / 1ms', 'NVIDIA G-Sync Compatible y AMD FreeSync Premium', 'HDR10', 'HDMI + DisplayPort'],
            'asus-rog-pg34wcdm' => ['34" WQHD (3440x1440) OLED curvo', '240Hz / 0.03ms', 'USB-C 90W con KVM integrado', 'NVIDIA G-Sync Compatible', 'Brillo pico de 1300 nits'],
            'asus-tuf-vg34wq5a' => ['34" WQHD (3440x1440) curvo 1500R', '200Hz (modo dual hasta 400Hz en 720p)', 'AMD FreeSync Premium', 'DisplayHDR 400', '95% DCI-P3'],
            'asus-proart-pa27jcv' => ['27" 5K (5120x2880) IPS', 'Delta E <2 calibrado de fábrica', '100% sRGB / 99% DCI-P3', 'USB-C 96W con hub y KVM', 'VESA DisplayHDR 500'],
            'msi-mpg-321urx' => ['31.5" 4K UHD (3840x2160) QD-OLED', '240Hz / 0.03ms', 'VESA DisplayHDR True Black 400', 'USB-C 90W', '99% DCI-P3'],

            'razer-iskur-v2-x-newgen' => ['Soporte lumbar integrado', 'Reclinado hasta 152°', 'Apoyabrazos 2D', 'Para usuarios de 160 a 190cm', 'Carga máxima 136kg'],
            'xpg-nexus-roja' => ['Soporte lumbar integrado en el respaldo', 'Tela repelente al agua', 'Apoyabrazos 2D ajustables', 'Reclinado de 90° a 155°'],
            'silla-t3-charcoal' => ['Estructura de acero reforzada', 'Ajuste de altura a gas', 'Reclinado ajustable', 'Apoyabrazos fijos acolchados'],
            'corsair-tc100-relaxed' => ['Tapiz de cuero PU', 'Asiento ancho estilo relajado', 'Soporte lumbar ajustable', 'Apoyabrazos 4D'],
            'corsair-tc500-luxe-shadow' => ['Soporte lumbar ajustable en 4 direcciones', 'Apoyabrazos Omni-Flex', 'Cojín cervical magnético desmontable', 'Estructura de acero, carga máx. 120kg', 'Garantía Corsair de 2 años'],

            'view-380-tg-black' => ['4x ventiladores ARGB de 120mm incluidos', 'Doble cámara (dual chamber)', 'Soporta radiador de 360mm arriba', 'Hasta 415mm de largo para GPU', 'Compatible con placas hidden-connector'],
            'view-380-tg-green' => ['4x ventiladores ARGB de 120mm incluidos', 'Doble cámara (dual chamber)', 'Soporta radiador de 360mm arriba', 'Panel frontal y lateral de vidrio templado'],
            'view-380-ws-white' => ['4x ventiladores ARGB de 120mm incluidos', 'Interior y exterior en blanco', 'Doble cámara (dual chamber)', 'Panel frontal y lateral de vidrio templado'],
            'view-270-tg-black' => ['Ventilador ARGB de 140mm incluido', 'Soporta radiador de 360mm arriba', 'Panel de vidrio templado', 'Compatible con ATX, mATX, Mini-ITX'],
            'versa-h18-white' => ['Formato Micro-ATX', 'Panel lateral de vidrio templado', 'Soporta AIO de hasta 280mm al frente', 'GPU de hasta 350mm sin ventiladores frontales'],

            'rtx-5070-ti-frieren' => ['16GB GDDR7', '8.960 CUDA Cores', 'Bus de 256-bit / 896 GB/s', 'Edición de colección con caja temática', 'PCIe 5.0'],
            'palit-rtx-5070-white' => ['12GB GDDR7', '6.144 CUDA Cores', 'Bus de 192-bit / 672 GB/s', 'Triple ventilador', 'PCIe 5.0, HDMI 2.1b + 3x DisplayPort 2.1'],
            'asus-dual-rtx-5060ti' => ['8GB GDDR7', '4608 CUDA Cores', 'Bus de 128-bit', 'Diseño de 2.5 slots, doble ventilador Axial-tech', '0dB Technology'],
            'asrock-rx-9060xt-challenger' => ['16GB GDDR6', 'Arquitectura RDNA 4 (32 compute units)', 'Bus de 128-bit / 20Gbps', 'Doble ventilador, 0dB silencioso', 'PCIe 5.0'],

            'ryzen-7-5800xt' => ['8 núcleos / 16 hilos', 'Socket AM4', 'Arquitectura Zen 3', 'Compatible con placas B450/X470/B550/X570 (con actualización de BIOS)'],
            'intel-core-i7-14700k' => ['20 núcleos (8P + 12E) / 28 hilos', 'Multiplicador desbloqueado (K)', 'Socket LGA1700', 'Compatible con DDR4 y DDR5 (según placa)'],
            'ryzen-5-7600x3d' => ['6 núcleos / 12 hilos', '96MB de caché L3 (3D V-Cache)', 'Socket AM5', 'TDP de 65W', 'Compatible con A620, B650, X670'],
            'ryzen-7-7700x' => ['8 núcleos / 16 hilos', 'Socket AM5 (DDR5)', 'Arquitectura Zen 4', 'Frecuencia boost alta de fábrica'],
        ];
    }
}
