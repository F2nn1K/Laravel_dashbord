<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar se já existe um usuário admin
        $adminExists = DB::table('users')->where('email', 'admin@admin.com')->exists();

        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

