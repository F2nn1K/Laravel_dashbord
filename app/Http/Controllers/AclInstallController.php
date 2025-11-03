<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AclInstallController extends Controller
{
    public function install(Request $request)
    {
        $token = $request->query('token');
        $expected = env('ACL_INSTALL_TOKEN');

        if (empty($expected) || $token !== $expected) {
            return response()->json(['ok' => false, 'message' => 'Unauthorized'], 401);
        }

        try {
            // Garantir migrations atualizadas
            Artisan::call('migrate', ['--force' => true]);

            // Seed idempotente
            Artisan::call('db:seed', [
                '--class' => \Database\Seeders\PermissionsSeeder::class,
                '--force' => true,
            ]);

            // Admin user
            Artisan::call('db:seed', [
                '--class' => \Database\Seeders\AdminUserSeeder::class,
                '--force' => true,
            ]);

            $counts = [
                'permissions' => Schema::hasTable('permissions') ? (int) DB::table('permissions')->count() : 0,
                'roles' => Schema::hasTable('roles') ? (int) DB::table('roles')->count() : 0,
                'role_permission' => Schema::hasTable('role_permission') ? (int) DB::table('role_permission')->count() : 0,
                'user_role' => Schema::hasTable('user_role') ? (int) DB::table('user_role')->count() : 0,
            ];

            return response()->json([
                'ok' => true,
                'message' => 'ACL instalada/atualizada',
                'counts' => $counts,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'ok' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}


