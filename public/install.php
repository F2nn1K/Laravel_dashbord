<?php
// INSTALADOR DO BANCO - NÃO DEPENDE DO LARAVEL!
// Acesse: /install.php?token=marudi2025

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Estilo
echo '<html><head><title>Instalação</title>';
echo '<style>body{font-family:monospace;background:#0f172a;color:#e2e8f0;padding:20px;line-height:1.6}';
echo 'pre{background:#1e293b;padding:20px;border-radius:8px;border-left:4px solid #10b981}';
echo 'h1{color:#10b981}</style></head><body>';
echo '<h1>🚀 Instalação do Banco de Dados</h1><pre>';

// Verificar token
$token = $_GET['token'] ?? '';
if ($token !== 'marudi2025') {
    echo "❌ Token inválido!\n\n";
    echo "Acesse: /install.php?token=marudi2025\n";
    echo '</pre></body></html>';
    exit;
}

echo "🔍 Verificando ambiente...\n\n";

// Carregar Composer Autoload
$autoload = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($autoload)) {
    echo "❌ ERRO: vendor/autoload.php não encontrado!\n";
    echo "Execute: composer install\n";
    exit;
}

require $autoload;

// Carregar Bootstrap do Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
echo "✅ Laravel carregado\n";

// Criar Kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
echo "✅ Kernel criado\n\n";

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "📦 EXECUTANDO MIGRATIONS\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

try {
    // Migrations
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    $kernel->call('migrate', ['--force' => true], $output);
    echo $output->fetch();
    echo "\n✅ Migrations concluídas!\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🔐 CRIANDO PERMISSÕES\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Seed
    $output2 = new \Symfony\Component\Console\Output\BufferedOutput();
    $kernel->call('db:seed', ['--class' => 'PermissionsSeeder', '--force' => true], $output2);
    echo $output2->fetch();
    echo "\n✅ Permissões criadas!\n\n";
    
    // Limpar cache
    $kernel->call('config:clear');
    $kernel->call('cache:clear');
    $kernel->call('view:clear');
    $kernel->call('route:clear');
    echo "✅ Cache limpo!\n";
    
    // Cachear config
    $kernel->call('config:cache');
    echo "✅ Config cacheada!\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🎉 INSTALAÇÃO COMPLETA!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    echo "👤 Usuário: admin\n";
    echo "🔑 Senha: admin123\n\n";
    echo "➡️ Acesse: <a href='/login' style='color:#10b981'>/login</a>\n";
    
} catch (\Exception $e) {
    echo "❌ ERRO:\n";
    echo $e->getMessage() . "\n\n";
    echo "Stack trace:\n";
    echo $e->getTraceAsString() . "\n";
}

echo '</pre></body></html>';

