<?php
// VERIFICAR E CRIAR USUÁRIO ADMIN - Acesse: /check-admin.php?token=marudi2025

header('Content-Type: text/html; charset=utf-8');

echo '<html><head><title>Admin User</title>';
echo '<style>body{font-family:monospace;background:#0f172a;color:#e2e8f0;padding:20px}';
echo 'pre{background:#1e293b;padding:20px;border-radius:8px;border-left:4px solid #10b981}';
echo '.credentials{background:#fef3c7;color:#92400e;padding:15px;border-radius:8px;margin:15px 0;font-size:16px}';
echo 'h1{color:#10b981}</style></head><body>';
echo '<h1>👤 Verificar Usuário Admin</h1><pre>';

// Verificar token
$token = $_GET['token'] ?? '';
if ($token !== 'marudi2025') {
    echo "❌ Token inválido! Acesse: /check-admin.php?token=marudi2025\n";
    exit;
}

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🔍 VERIFICANDO USUÁRIO ADMIN\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Conectar ao banco
    $pdo = $app->make('db')->connection()->getPdo();
    
    // Verificar se admin existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name = 'admin' LIMIT 1");
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "✅ Usuário admin EXISTE!\n\n";
        echo "ID: " . $admin['id'] . "\n";
        echo "Nome: " . $admin['name'] . "\n";
        echo "Email: " . $admin['email'] . "\n";
        echo "Status: " . $admin['in_estatus'] . "\n\n";
        
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "🔄 RESETANDO SENHA PARA 'admin123'\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        
        // Resetar senha para admin123
        $newPassword = password_hash('admin123', PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE name = 'admin'");
        $stmt->execute([$newPassword]);
        
        echo "✅ Senha atualizada com sucesso!\n\n";
        
    } else {
        echo "⚠️ Usuário admin NÃO EXISTE!\n\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "👤 CRIANDO USUÁRIO ADMIN\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        
        $password = password_hash('admin123', PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, password, role, cadastro, in_estatus, created_at, updated_at)
            VALUES ('admin', 'admin@marudimountain.com', ?, 'admin', 'outro', 'ativo', NOW(), NOW())
        ");
        $stmt->execute([$password]);
        
        echo "✅ Usuário admin criado com sucesso!\n\n";
    }
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🎉 CREDENCIAIS ATUALIZADAS\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    echo "</pre>";
    echo "<div class='credentials'>";
    echo "👤 <strong>Usuário:</strong> admin<br>";
    echo "🔑 <strong>Senha:</strong> admin123";
    echo "</div>";
    echo "<pre>\n\n";
    
    echo "➡️ Acesse: <a href='/login' style='color:#10b981;font-weight:bold'>/login</a>\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "✅ TUDO PRONTO PARA USAR!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    
} catch (\Exception $e) {
    echo "❌ ERRO:\n\n";
    echo $e->getMessage() . "\n\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}

echo '</pre></body></html>';

