<?php
// TESTAR LOGIN DIRETO - Acesse: /test-login.php?token=marudi2025

header('Content-Type: text/html; charset=utf-8');

echo '<html><head><title>Test Login</title>';
echo '<style>body{font-family:monospace;background:#0f172a;color:#e2e8f0;padding:20px}';
echo 'pre{background:#1e293b;padding:20px;border-radius:8px;border-left:4px solid #10b981}</style>';
echo '</head><body><h1 style="color:#10b981">🧪 Testar Sistema de Login</h1><pre>';

// Verificar token
$token = $_GET['token'] ?? '';
if ($token !== 'marudi2025') {
    echo "❌ Token inválido! Acesse: /test-login.php?token=marudi2025\n";
    exit;
}

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🧹 LIMPANDO CACHE DE ROTAS\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    $kernel->call('route:clear');
    $kernel->call('config:clear');
    echo "✅ Cache de rotas limpo!\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🔍 VERIFICANDO USUÁRIO ADMIN\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    $pdo = $app->make('db')->connection()->getPdo();
    
    // Buscar admin
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name = 'admin' LIMIT 1");
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$admin) {
        echo "❌ Usuário admin NÃO EXISTE!\n\n";
        echo "Criando usuário admin...\n";
        
        $password = password_hash('admin123', PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, password, role, cadastro, in_estatus, created_at, updated_at)
            VALUES ('admin', 'admin@marudimountain.com', ?, 'admin', 'outro', 'ativo', NOW(), NOW())
        ");
        $stmt->execute([$password]);
        echo "✅ Admin criado!\n\n";
    } else {
        echo "✅ Admin existe!\n";
        echo "ID: " . $admin['id'] . "\n";
        echo "Nome: " . $admin['name'] . "\n";
        echo "Email: " . $admin['email'] . "\n\n";
    }
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🔐 TESTANDO AUTENTICAÇÃO\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Testar se a senha 'admin123' funciona
    $password = 'admin123';
    $passwordHash = $admin['password'] ?? '';
    
    if (password_verify($password, $passwordHash)) {
        echo "✅ Senha 'admin123' está CORRETA!\n\n";
    } else {
        echo "❌ Senha 'admin123' NÃO funciona!\n";
        echo "Resetando senha para 'admin123'...\n";
        
        $newPassword = password_hash('admin123', PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE name = 'admin'");
        $stmt->execute([$newPassword]);
        
        echo "✅ Senha resetada com sucesso!\n\n";
    }
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "📋 CREDENCIAIS FINAIS\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    echo "</pre>";
    echo "<div style='background:#fef3c7;color:#92400e;padding:20px;border-radius:8px;margin:15px 0;font-size:18px'>";
    echo "<strong>👤 Usuário:</strong> admin<br>";
    echo "<strong>🔑 Senha:</strong> admin123";
    echo "</div>";
    echo "<pre>\n\n";
    
    echo "➡️ Acesse: <a href='/login' style='color:#10b981;font-weight:bold'>/login</a>\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "⚠️ SE AINDA DER ERRO 405:\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    echo "O problema pode ser cache do navegador.\n";
    echo "Soluções:\n";
    echo "1. Limpe o cache do navegador (Ctrl+Shift+Delete)\n";
    echo "2. Abra em janela anônima (Ctrl+Shift+N)\n";
    echo "3. Force reload (Ctrl+F5)\n";
    
} catch (\Exception $e) {
    echo "❌ ERRO:\n\n";
    echo $e->getMessage() . "\n\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}

echo '</pre></body></html>';

