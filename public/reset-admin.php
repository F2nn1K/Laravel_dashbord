<?php
// RESETAR SENHA DO ADMIN - Acesse: /reset-admin.php?token=marudi2025

header('Content-Type: text/html; charset=utf-8');

echo '<html><head><title>Reset Admin</title>';
echo '<style>body{font-family:monospace;background:#0f172a;color:#e2e8f0;padding:20px}';
echo 'pre{background:#1e293b;padding:20px;border-radius:8px;border-left:4px solid #ef4444}';
echo '.success{background:#10b981;color:#fff;padding:20px;border-radius:8px;margin:20px 0;font-size:18px}';
echo 'h1{color:#ef4444}</style></head><body>';
echo '<h1>🔐 Resetar Senha do Admin</h1><pre>';

// Verificar token
$token = $_GET['token'] ?? '';
if ($token !== 'marudi2025') {
    echo "❌ Token inválido! Acesse: /reset-admin.php?token=marudi2025\n";
    exit;
}

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🔍 CONECTANDO AO BANCO\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Forçar boot do framework
    $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
    
    // Conectar ao banco
    $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "✅ Conectado ao PostgreSQL!\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "👤 VERIFICANDO USUÁRIOS\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Listar todos os usuários
    $stmt = $pdo->query("SELECT id, name, email, role FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Usuários no banco: " . count($users) . "\n\n";
    
    foreach ($users as $user) {
        echo "• ID: " . $user['id'] . " | Nome: " . $user['name'] . " | Email: " . $user['email'] . "\n";
    }
    
    echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🔄 DELETANDO USUÁRIO ADMIN ANTIGO\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Deletar admin antigo
    $stmt = $pdo->prepare("DELETE FROM users WHERE name = 'admin'");
    $stmt->execute();
    echo "✅ Admin antigo deletado!\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "👤 CRIANDO NOVO USUÁRIO ADMIN\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Criar novo admin com senha admin123
    $password = password_hash('admin123', PASSWORD_BCRYPT, ['cost' => 12]);
    
    $stmt = $pdo->prepare("
        INSERT INTO users (name, email, password, role, cadastro, created_at, updated_at)
        VALUES ('admin', 'admin@marudimountain.com', ?, 'admin', 'outro', NOW(), NOW())
    ");
    $stmt->execute([$password]);
    
    $adminId = $pdo->lastInsertId();
    
    echo "✅ Usuário admin criado!\n";
    echo "ID: $adminId\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "🔐 TESTANDO A SENHA\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Buscar admin novamente
    $stmt = $pdo->prepare("SELECT password FROM users WHERE name = 'admin' LIMIT 1");
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (password_verify('admin123', $admin['password'])) {
        echo "✅ Senha 'admin123' funciona perfeitamente!\n\n";
    } else {
        echo "❌ ERRO: Senha não funciona!\n\n";
    }
    
    echo "</pre>";
    echo "<div class='success'>";
    echo "<strong>🎉 ADMIN RESETADO COM SUCESSO!</strong><br><br>";
    echo "👤 <strong>Usuário:</strong> admin<br>";
    echo "🔑 <strong>Senha:</strong> admin123<br><br>";
    echo "➡️ <a href='/login' style='color:#fff;text-decoration:underline;font-weight:bold'>CLIQUE AQUI PARA FAZER LOGIN</a>";
    echo "</div>";
    echo "<pre>\n\n";
    
    echo "⚠️ IMPORTANTE: Use EXATAMENTE estas credenciais:\n";
    echo "• Usuário: admin (sem espaços, minúsculo)\n";
    echo "• Senha: admin123 (sem espaços)\n";
    
} catch (\Exception $e) {
    echo "❌ ERRO:\n\n";
    echo $e->getMessage() . "\n\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}

echo '</pre></body></html>';

