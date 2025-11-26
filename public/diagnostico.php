<?php
// Diagnóstico do Sistema - NÃO depende do Laravel

header('Content-Type: text/html; charset=utf-8');

echo '<html><head><title>Diagnóstico</title>';
echo '<style>body{font-family:monospace;background:#0f172a;color:#e2e8f0;padding:20px}';
echo 'pre{background:#1e293b;padding:15px;border-radius:8px;border-left:3px solid #10b981}</style>';
echo '</head><body>';
echo '<h1>🔍 Diagnóstico do Sistema</h1>';
echo '<pre>';

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "📊 INFORMAÇÕES DO SERVIDOR\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "✅ PHP Version: " . PHP_VERSION . "\n";
echo "✅ Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . "\n";
echo "✅ Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . "\n";
echo "✅ Script Filename: " . __FILE__ . "\n\n";

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "🗄️ VARIÁVEIS DE AMBIENTE (BANCO)\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

$dbVars = ['DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME'];
foreach ($dbVars as $var) {
    $value = getenv($var);
    if ($var === 'DB_PASSWORD') {
        echo "🔐 $var: " . ($value ? '***SET***' : '❌ NOT SET') . "\n";
    } else {
        echo ($value ? "✅" : "❌") . " $var: " . ($value ?: 'NOT SET') . "\n";
    }
}

echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "🔌 TESTE DE CONEXÃO COM BANCO\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

$dbHost = getenv('DB_HOST');
$dbPort = getenv('DB_PORT') ?: '5432';
$dbName = getenv('DB_DATABASE');
$dbUser = getenv('DB_USERNAME');
$dbPass = getenv('DB_PASSWORD');

if ($dbHost && $dbName && $dbUser) {
    try {
        $dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName";
        $pdo = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_TIMEOUT => 5,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        
        echo "✅ CONEXÃO ESTABELECIDA COM SUCESSO!\n";
        echo "✅ Banco: PostgreSQL " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n\n";
        
        // Testar se tabelas existem
        $stmt = $pdo->query("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (count($tables) > 0) {
            echo "✅ Tabelas encontradas (" . count($tables) . "): " . implode(', ', array_slice($tables, 0, 5));
            if (count($tables) > 5) echo " ...";
            echo "\n\n";
            echo "➡️ Banco JÁ ESTÁ INSTALADO!\n";
            echo "➡️ Acesse: /login\n";
        } else {
            echo "⚠️ Banco conectado mas SEM TABELAS\n\n";
            echo "➡️ Execute a instalação: /setup?token=marudi2025\n";
        }
        
    } catch (PDOException $e) {
        echo "❌ ERRO DE CONEXÃO:\n";
        echo "   " . $e->getMessage() . "\n\n";
        
        if (strpos($e->getMessage(), 'timeout') !== false) {
            echo "💡 SOLUÇÃO: Banco ainda está inicializando.\n";
            echo "   Aguarde 2-3 minutos e recarregue esta página.\n";
        } else if (strpos($e->getMessage(), 'password') !== false) {
            echo "💡 SOLUÇÃO: Credenciais incorretas.\n";
            echo "   Verifique as variáveis de ambiente no Render.\n";
        } else {
            echo "💡 SOLUÇÃO: Verifique o status do banco no Render.\n";
        }
    }
} else {
    echo "❌ VARIÁVEIS DE AMBIENTE NÃO CONFIGURADAS\n\n";
    echo "Faltando: ";
    if (!$dbHost) echo "DB_HOST ";
    if (!$dbName) echo "DB_DATABASE ";
    if (!$dbUser) echo "DB_USERNAME ";
    echo "\n\n💡 Configure as variáveis no Render.\n";
}

echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "📌 PRÓXIMOS PASSOS\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
echo "1️⃣ Se o banco está conectado mas sem tabelas:\n";
echo "   → /setup?token=marudi2025\n\n";
echo "2️⃣ Se já tem tabelas:\n";
echo "   → /login\n\n";
echo "3️⃣ Se erro de conexão:\n";
echo "   → Aguarde 2-3 minutos e recarregue\n";

echo '</pre></body></html>';

