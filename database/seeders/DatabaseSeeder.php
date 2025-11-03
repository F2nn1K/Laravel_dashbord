<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ACL (idempotente)
        $this->call(PermissionsSeeder::class);

        // Criar usuário admin (idempotente)
        $this->call(AdminUserSeeder::class);
    }
}
