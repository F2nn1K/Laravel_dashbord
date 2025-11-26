<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SetupController extends Controller
{
    public function install(Request $request)
    {
        // Desabilitar display de erros para controlar saída
        ini_set('display_errors', 0);
        
        // Token de segurança simples
        $token = $request->query('token', '');
        
        if ($token !== 'marudi2025') {
            return response('<pre>❌ Token Inválido\n\nAcesse: /setup?token=marudi2025</pre>', 403)
                ->header('Content-Type', 'text/html');
        }

        $log = [];
        $log[] = '🚀 MARUDI MOUNTAIN - SETUP INICIAL';
        $log[] = '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
        $log[] = '';
        
        try {
            // Testar conexão com banco
            $log[] = '⏳ Testando conexão com banco PostgreSQL...';
            
            try {
                DB::connection()->getPdo();
                $log[] = '✅ Conectado ao banco PostgreSQL!';
            } catch (\Exception $e) {
                $log[] = '❌ ERRO: Não foi possível conectar ao banco';
                $log[] = 'Detalhes: ' . $e->getMessage();
                $log[] = '';
                $log[] = '💡 SOLUÇÃO:';
                $log[] = '1. O banco PostgreSQL pode estar inicializando';
                $log[] = '2. Aguarde 1-2 minutos e recarregue esta página';
                $log[] = '3. Se persistir, verifique as variáveis de ambiente no Render';
                
                return $this->htmlResponse('⏳ Banco Inicializando', $log, false);
            }
            
            // Rodar migrations
            $log[] = '';
            $log[] = '📦 Executando migrations...';
            Artisan::call('migrate', ['--force' => true]);
            $migrationOutput = trim(Artisan::output());
            if ($migrationOutput) {
                $log[] = $migrationOutput;
            }
            $log[] = '✅ Migrations concluídas!';
            
            // Seed de permissões
            $log[] = '';
            $log[] = '🔐 Criando permissões e usuário admin...';
            Artisan::call('db:seed', ['--class' => 'PermissionsSeeder', '--force' => true]);
            $seedOutput = trim(Artisan::output());
            if ($seedOutput) {
                $log[] = $seedOutput;
            }
            $log[] = '✅ Permissões criadas!';
            
            // Limpar caches
            $log[] = '';
            $log[] = '🧹 Limpando caches...';
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            $log[] = '✅ Cache limpo!';
            
            $log[] = '';
            $log[] = '━━━━━━━━━━━━━━━━━━━━━━━━━━━';
            $log[] = '🎉 INSTALAÇÃO COMPLETA!';
            $log[] = '━━━━━━━━━━━━━━━━━━━━━━━━━━━';
            $log[] = '';
            $log[] = '👤 Usuário: admin';
            $log[] = '🔑 Senha: admin123';
            $log[] = '';
            $log[] = '➡️ Acesse: ' . url('/login');
            
            return $this->htmlResponse('✅ Instalação Completa', $log, true);
            
        } catch (\Exception $e) {
            $log[] = '';
            $log[] = '❌ ERRO: ' . $e->getMessage();
            $log[] = '';
            $log[] = 'Stack trace:';
            $log[] = $e->getTraceAsString();
            
            return $this->htmlResponse('❌ Erro na Instalação', $log, false);
        }
    }
    
    private function htmlResponse($title, $log, $success)
    {
        $statusColor = $success ? '#10b981' : '#ef4444';
        $logHtml = '';
        
        foreach ($log as $line) {
            $logHtml .= htmlspecialchars($line) . "\n";
        }
        
        $loginButton = $success ? '<a href="' . url('/login') . '" style="display:inline-block;margin-top:20px;padding:12px 24px;background:#6366f1;color:white;text-decoration:none;border-radius:8px;font-weight:bold;">🚀 Ir para Login</a>' : '';
        
        $html = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title} - Marudi Mountain</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #1e293b;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }
        h1 {
            color: {$statusColor};
            margin-top: 0;
            font-size: 28px;
        }
        pre {
            background: #0f172a;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            line-height: 1.6;
            border-left: 4px solid {$statusColor};
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #334155;
            color: #94a3b8;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{$title}</h1>
        <pre>{$logHtml}</pre>
        {$loginButton}
        <div class="footer">
            <strong>Marudi Mountain</strong> - Sistema de Gestão de Vendas<br>
            Powered by Laravel 12 + PostgreSQL
        </div>
    </div>
</body>
</html>
HTML;
        
        return response($html, $success ? 200 : 500)->header('Content-Type', 'text/html');
    }
}

