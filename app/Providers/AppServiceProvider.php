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
        // Detectar schema automaticamente (HTTP ou HTTPS) – nunca falhar a request
        try {
            $isHttps = false;
            if (function_exists('request')) {
                $req = request();
                $isHttps = ($req && ($req->isSecure() || $req->header('X-Forwarded-Proto') === 'https'));
            }
            if (!$isHttps && isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
                $isHttps = $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https';
            }
            if ($isHttps) {
                \Illuminate\Support\Facades\URL::forceScheme('https');
            }
        } catch (\Throwable $e) {
            // Ignorar qualquer erro aqui para não derrubar a aplicação em produção
            \Log::warning('forceScheme ignorado: ' . $e->getMessage());
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
