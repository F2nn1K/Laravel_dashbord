<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Detectar schema automaticamente (HTTP ou HTTPS)
        if (request()->isSecure() || request()->header('X-Forwarded-Proto') === 'https') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Auto-seed do ACL em produção, se necessário (idempotente)
        try {
            if (\Schema::hasTable('permissions') && \Schema::hasTable('roles')) {
                $permCount = \DB::table('permissions')->count();
                $roleCount = \DB::table('roles')->count();
                if ($permCount === 0 || $roleCount === 0) {
                    \Artisan::call('db:seed', [
                        '--class' => \Database\Seeders\PermissionsSeeder::class,
                        '--force' => true,
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Não falhar o request se o banco não estiver pronto
            \Log::warning('ACL auto-seed falhou/ignorado: ' . $e->getMessage());
        }
    }
}
