<?php
// MOSTRAR ERRO REAL - Acesse: /show-error.php?token=marudi2025

// ATIVAR MODO DEBUG
putenv('APP_DEBUG=true');
putenv('APP_ENV=local');

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificar token
$token = $_GET['token'] ?? '';
if ($token !== 'marudi2025') {
    die('❌ Token inválido! Acesse: /show-error.php?token=marudi2025');
}

echo "🔍 Carregando Laravel com DEBUG ativado...\n\n";

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    // Forçar debug mode
    $app['config']['app.debug'] = true;
    $app['config']['app.env'] = 'local';
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $request = Illuminate\Http\Request::create('/login', 'GET');
    
    $response = $kernel->handle($request);
    
    echo "Status: " . $response->getStatusCode() . "\n\n";
    echo "Conteúdo:\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Mostrar conteúdo direto (com erros detalhados)
    echo $response->getContent();
    
    $kernel->terminate($request, $response);
    
} catch (\Throwable $e) {
    echo "\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "❌ ERRO CAPTURADO:\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    echo "Mensagem: " . $e->getMessage() . "\n\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n\n";
    echo "Stack Trace:\n";
    echo $e->getTraceAsString() . "\n";
}

