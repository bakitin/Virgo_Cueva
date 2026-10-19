<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PaginasInformativasTest extends TestCase
{
    /**
     * @return array<string, array{string, string}>
     */
    public static function paginas(): array
    {
        return [
            'nosotros' => ['nosotros', 'Quiénes somos'],
            'garantía' => ['garantia', 'Garantía y soporte'],
            'cambios y devoluciones' => ['cambios_devoluciones', 'Cambios y devoluciones'],
            'pago seguro' => ['pago_seguro', 'Pago 100% seguro'],
            'preguntas frecuentes' => ['faq', 'Preguntas frecuentes'],
        ];
    }

    #[DataProvider('paginas')]
    public function test_informative_page_renders_inside_the_store_layout(string $routeName, string $heading): void
    {
        $response = $this->get(route($routeName));

        $response->assertOk();
        $response->assertSee($heading);
        $response->assertSee('Logo La Virgo Cueva');
    }
}
