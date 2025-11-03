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
        // Criar usuário admin
        $this->call(AdminUserSeeder::class);
        
        // Criar permissões e perfis (ACL)
        // Só roda se as tabelas existirem
        if (\Schema::hasTable('permissions') && \Schema::hasTable('roles')) {
            $this->call(PermissionsSeeder::class);
        }
    }
}
