<?php
// DEBUG - Mostra erro real do Laravel
// Acesse: /debug.php

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: text/html; charset=utf-8');

echo '<html><head><title>Debug</title>';
echo '<style>body{font-family:monospace;background:#0f172a;color:#e2e8f0;padding:20px}';
echo 'pre{background:#1e293b;padding:15px;border-radius:8px;border-left:3px solid #ef4444;overflow:auto}</style>';
echo '</head><body>';
echo '<h1 style="color:#ef4444">🔍 Debug do Laravel</h1><pre>';

try {
    require __DIR__ . '/../vendor/autoload.php';
    echo "✅ Autoload carregado\n\n";
    
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "✅ Laravel App criado\n\n";
    
    // Testar .env
    $envPath = __DIR__ . '/../.env';
    if (!file_exists($envPath)) {
        echo "⚠️ ALERTA: Arquivo .env não existe!\n";
        echo "O Render deve usar variáveis de ambiente diretamente.\n\n";
    } else {
        echo "✅ Arquivo .env existe\n\n";
    }
    
    // Testar APP_KEY
    $appKey = env('APP_KEY') ?: getenv('APP_KEY');
    if (!$appKey) {
        echo "❌ ERRO CRÍTICO: APP_KEY não configurada!\n\n";
        echo "SOLUÇÃO:\n";
        echo "1. Vá no Render → Environment\n";
        echo "2. Adicione:\n";
        echo "   Key: APP_KEY\n";
        echo "   Value: base64:tfMTtkbsE3NcTwtgxBSihqzviyWJy1LParVdLN3fGGw=\n\n";
    } else {
        echo "✅ APP_KEY configurada: " . substr($appKey, 0, 20) . "...\n\n";
    }
    
    // Criar Kernel e testar
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "✅ HTTP Kernel criado\n\n";
    
    // Criar Request simples
    $request = Illuminate\Http\Request::create('/login', 'GET');
    echo "✅ Request criado para /login\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🔄 Tentando processar /login...\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    $response = $kernel->handle($request);
    
    echo "✅ Response recebida!\n";
    echo "Status: " . $response->getStatusCode() . "\n\n";
    
    if ($response->getStatusCode() === 200) {
        echo "🎉 /login está funcionando!\n";
        echo "➡️ Acesse: <a href='/login' style='color:#10b981'>/login</a>\n";
    } else {
        echo "⚠️ Status: " . $response->getStatusCode() . "\n";
        echo "Content: " . substr($response->getContent(), 0, 500) . "\n";
    }
    
} catch (\Exception $e) {
    echo "❌ ERRO CAPTURADO:\n\n";
    echo "Mensagem: " . $e->getMessage() . "\n\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n\n";
    echo "Stack Trace:\n";
    echo $e->getTraceAsString() . "\n";
}

echo '</pre></body></html>';

