<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Correo con el que entra el administrador. Solo para desarrollo: la contraseña es "admin".
     */
    public const EMAIL = 'admin@lavirgocueva.co';

    /**
     * Crea (o deja al día) el único usuario que puede entrar al panel de administración.
     */
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => self::EMAIL]);
        $admin->name = 'Administrador';
        $admin->password = 'admin';
        $admin->is_admin = true;
        $admin->save();
    }
}
