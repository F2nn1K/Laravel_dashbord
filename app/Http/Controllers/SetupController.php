<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SetupController extends Controller
{
    public function install(Request $request)
    {
        // Token de segurança simples
        $token = $request->query('token', '');
        
        if ($token !== 'marudi2025') {
            return response()->json([
                'error' => 'Token inválido',
                'instrucao' => 'Acesse: /setup?token=marudi2025'
            ], 403);
        }

        $log = [];
        
        try {
            // Testar conexão com banco
            $log[] = '✅ Testando conexão com banco...';
            DB::connection()->getPdo();
            $log[] = '✅ Conectado ao banco PostgreSQL!';
            
            // Rodar migrations
            $log[] = '📦 Executando migrations...';
            Artisan::call('migrate', ['--force' => true]);
            $log[] = Artisan::output();
            $log[] = '✅ Migrations concluídas!';
            
            // Seed de permissões
            $log[] = '🔐 Criando permissões e usuário admin...';
            Artisan::call('db:seed', ['--class' => 'PermissionsSeeder', '--force' => true]);
            $log[] = Artisan::output();
            $log[] = '✅ Permissões criadas!';
            
            // Limpar caches
            $log[] = '🧹 Limpando caches...';
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            $log[] = '✅ Cache limpo!';
            
            $log[] = '';
            $log[] = '🎉 INSTALAÇÃO COMPLETA!';
            $log[] = '';
            $log[] = '👤 Login: admin';
            $log[] = '🔑 Senha: admin123';
            $log[] = '';
            $log[] = '➡️ Acesse: /login';
            
            return response()->json([
                'success' => true,
                'log' => $log
            ]);
            
        } catch (\Exception $e) {
            $log[] = '❌ ERRO: ' . $e->getMessage();
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'log' => $log
            ], 500);
        }
    }
}

