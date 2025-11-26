<?php
// CORRIGIR CACHE E TESTAR - Acesse: /fix.php?token=marudi2025

header('Content-Type: text/html; charset=utf-8');

echo '<html><head><title>Fix</title>';
echo '<style>body{font-family:monospace;background:#0f172a;color:#e2e8f0;padding:20px}';
echo 'pre{background:#1e293b;padding:15px;border-radius:8px;border-left:3px solid #10b981}</style>';
echo '</head><body><h1 style="color:#10b981">🔧 Corrigindo Sistema</h1><pre>';

// Verificar token
$token = $_GET['token'] ?? '';
if ($token !== 'marudi2025') {
    echo "❌ Token inválido! Acesse: /fix.php?token=marudi2025\n";
    exit;
}

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🧹 LIMPANDO TODOS OS CACHES\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Limpar TUDO
    $commands = [
        'config:clear' => 'Config cache',
        'cache:clear' => 'Application cache',
        'view:clear' => 'View cache',
        'route:clear' => 'Route cache',
    ];
    
    foreach ($commands as $cmd => $desc) {
        try {
            $kernel->call($cmd);
            echo "✅ $desc limpo\n";
        } catch (\Exception $e) {
            echo "⚠️ $desc: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "📦 RECACHEANDO CONFIG\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    $kernel->call('config:cache');
    echo "✅ Config cacheada!\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🔍 TESTANDO /login\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Testar login
    $httpKernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $request = Illuminate\Http\Request::create('/login', 'GET');
    
    ob_start();
    $response = $httpKernel->handle($request);
    $captured = ob_get_clean();
    
    $status = $response->getStatusCode();
    
    if ($status === 200) {
        echo "✅ /login funcionando perfeitamente!\n";
        echo "Status: 200 OK\n\n";
        echo "🎉 SISTEMA 100% OPERACIONAL!\n\n";
        echo "➡️ Acesse: <a href='/login' style='color:#10b981;font-weight:bold'>/login</a>\n\n";
        echo "👤 Usuário: admin\n";
        echo "🔑 Senha: admin123\n";
    } else {
        echo "⚠️ Status: $status\n\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📄 CONTEÚDO COMPLETO DA RESPOSTA:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        
        $content = $response->getContent();
        
        // Mostrar TODO o conteúdo
        echo htmlspecialchars($content);
        
        echo "\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📋 ANÁLISE DO ERRO\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        
        // Procurar por erros específicos
        if (strpos($content, 'Vite') !== false || strpos($content, 'manifest') !== false) {
            echo "❌ PROBLEMA: Assets do Vite (CSS/JS)\n\n";
            echo "O que fazer:\n";
            echo "1. Verificar se public/build/manifest.json existe\n";
            echo "2. Verificar se public/build/assets/ tem arquivos\n";
        } else if (strpos($content, 'Class') !== false && strpos($content, 'not found') !== false) {
            echo "❌ PROBLEMA: Classe PHP não encontrada\n\n";
            echo "Solução: Rodar composer dump-autoload\n";
        } else if (strpos($content, 'View') !== false && strpos($content, 'not found') !== false) {
            echo "❌ PROBLEMA: View Blade não encontrada\n\n";
        } else {
            echo "⚠️ Erro não identificado automaticamente\n";
            echo "Veja o conteúdo acima para mais detalhes\n";
        }
    }
    
} catch (\Exception $e) {
    echo "❌ ERRO:\n\n";
    echo $e->getMessage() . "\n\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}

echo '</pre></body></html>';

