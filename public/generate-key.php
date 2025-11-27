<?php
// GERAR APP_KEY CORRETA - Acesse: /generate-key.php

header('Content-Type: text/html; charset=utf-8');

echo '<html><head><title>Gerar APP_KEY</title>';
echo '<style>body{font-family:monospace;background:#0f172a;color:#e2e8f0;padding:20px;line-height:1.8}';
echo 'pre{background:#1e293b;padding:20px;border-radius:8px;border-left:4px solid #10b981}';
echo '.key{background:#fef3c7;color:#92400e;padding:10px;border-radius:6px;font-weight:bold;margin:10px 0}';
echo 'h1{color:#10b981}</style></head><body>';
echo '<h1>🔑 Gerar APP_KEY para Laravel</h1><pre>';

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "🔐 GERANDO CHAVE DE CRIPTOGRAFIA\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

// Gerar chave de 32 bytes (256 bits) para AES-256-CBC
$key = base64_encode(random_bytes(32));
$appKey = 'base64:' . $key;

echo "✅ Chave gerada com sucesso!\n\n";

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "📋 COPIE ESTA CHAVE:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "</pre>";
echo "<div class='key'>$appKey</div>";
echo "<pre>\n\n";

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "📝 COMO CONFIGURAR NO RENDER:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "1. Vá no painel do Render\n";
echo "2. Clique no serviço 'marudi-mountain'\n";
echo "3. Vá em 'Environment' (menu lateral)\n";
echo "4. Procure a variável 'APP_KEY'\n";
echo "5. Clique em 'Edit' ou 'Add Environment Variable'\n";
echo "6. Cole a chave acima no campo 'Value'\n";
echo "7. Clique em 'Save Changes'\n";
echo "8. O Render vai reiniciar automaticamente\n";
echo "9. Aguarde 2-3 minutos\n";
echo "10. Acesse: /login\n\n";

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "⚡ ATENÇÃO:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "• A chave DEVE começar com 'base64:'\n";
echo "• Copie EXATAMENTE como está acima\n";
echo "• Não adicione espaços ou quebras de linha\n";
echo "• Após salvar, aguarde o redeploy automático\n\n";

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "✅ APÓS CONFIGURAR:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "1. Aguarde o redeploy terminar (2-3 min)\n";
echo "2. Acesse: <a href='/login' style='color:#10b981;font-weight:bold'>/login</a>\n";
echo "3. Faça login:\n";
echo "   👤 Usuário: admin\n";
echo "   🔑 Senha: admin123\n\n";

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "💡 GERENCIAR CHAVES:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "• Cada vez que acessar esta página, uma NOVA chave é gerada\n";
echo "• Use apenas se precisar trocar a chave\n";
echo "• Após configurar, esta página pode ser ignorada\n";

echo '</pre></body></html>';

