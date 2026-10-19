<?php

namespace Tests\Feature\Database\Seeders;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class AdminUserSeederTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_seeded_admin_logs_in_with_password_admin_and_reaches_the_panel(): void
    {
        $this->seed(AdminUserSeeder::class);
        $this->post(route('login'), ['email' => 'admin@lavirgocueva.co', 'password' => 'admin']);

        $response = $this->get(route('admin.productos.index'));

        $response->assertOk();
    }

    public function test_running_the_seeder_twice_keeps_a_single_admin(): void
    {
        $this->seed(AdminUserSeeder::class);

        $this->seed(AdminUserSeeder::class);

        $this->assertSame(1, User::where('is_admin', true)->count());
    }
}
