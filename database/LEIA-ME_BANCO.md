# 📁 GUIA DE INSTALAÇÃO DO BANCO DE DADOS

## 🎯 Arquivos Disponíveis

- **`schema.sql`** - SQL completo para criar todas as tabelas

## 🚀 COMO USAR

### **Opção 1: Importar via MySQL/phpMyAdmin**

1. Acesse o **phpMyAdmin** ou **MySQL Workbench**
2. Abra o arquivo `database/schema.sql`
3. Execute o script completo
4. O banco `marudimountain` será criado automaticamente

### **Opção 2: Via linha de comando MySQL**

```bash
mysql -u root -p < database/schema.sql
```

### **Opção 3: Via XAMPP/WAMP**

1. Inicie o MySQL pelo painel XAMPP/WAMP
2. Acesse: http://localhost/phpmyadmin
3. Vá em "Importar"
4. Selecione o arquivo `schema.sql`
5. Clique em "Executar"

---

## ⚙️ CONFIGURAR O LARAVEL

Após criar o banco, edite o arquivo **`.env`** na raiz do projeto:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marudimountain
DB_USERNAME=root
DB_PASSWORD=sua_senha_aqui
```

---

## 👤 USUÁRIO PADRÃO CRIADO

O SQL já cria um usuário administrador:

- **Email:** admin@marudimountain.com
- **Senha:** admin123

⚠️ **IMPORTANTE:** Altere a senha após o primeiro login!

---

## 📋 TABELAS CRIADAS

O schema cria as seguintes tabelas:

### **Autenticação e Sistema:**
- `users` - Usuários do sistema
- `password_reset_tokens` - Recuperação de senha
- `sessions` - Sessões ativas
- `cache`, `cache_locks` - Cache
- `jobs`, `job_batches`, `failed_jobs` - Filas

### **Configurações:**
- `zona_horaria` - Zonas horárias
- `forma_pagamento` - Formas de pagamento

### **Administração:**
- `empresas` - Empresas cadastradas
- `funcionarios` - Funcionários

### **Clientes:**
- `asociados` - Clientes tipo Asociados
- `investidores` - Clientes tipo Investidores
- `outros` - Clientes tipo Outros

### **Produtos e Vendas:**
- `produtos` - Catálogo de produtos
- `abrir_encerrar_venda` - Períodos de venda
- `venda` - Registro de vendas

---

## ✅ VERIFICAR INSTALAÇÃO

Após importar o SQL e configurar o `.env`, execute:

```bash
php artisan migrate:status
```

Se todas as tabelas existirem, você verá a lista completa.

---

## 🔄 ALTERNATIVA: Usar Migrations do Laravel

Se preferir usar as migrations do Laravel em vez do SQL direto:

```bash
php artisan migrate
```

Isso criará as mesmas tabelas automaticamente.

---

## 📊 ESTRUTURA DE AUDITORIA

Todas as tabelas principais possuem campos de auditoria:

- `user_id_add` - Quem criou
- `user_id_upd` - Quem atualizou
- `user_id_del` - Quem deletou
- `fe_add` - Data/hora criação
- `fe_upd` - Data/hora atualização
- `fe_del` - Data/hora deleção
- `in_estatus` - Status (ativo/inativo)

---

## 🔐 SEGURANÇA

- Todas as senhas são criptografadas com bcrypt
- Foreign keys garantem integridade referencial
- Cascata de deleção configurada
- Campos ENUM para valores controlados

---

## 💡 DICAS

1. **Backup Regular:** Sempre faça backup antes de mudanças
2. **Senha do Admin:** Troque imediatamente após instalação
3. **Charset:** UTF-8 configurado para suportar acentos
4. **Engine:** InnoDB para suporte a transações

---

## 🆘 PROBLEMAS COMUNS

### Erro: "Table already exists"
```sql
DROP DATABASE IF EXISTS marudimountain;
```
Depois execute o schema.sql novamente.

### Erro: Foreign key constraint
Certifique-se de que:
1. O MySQL está em InnoDB (não MyISAM)
2. As tabelas são criadas na ordem correta (o SQL já está ordenado)

### Erro de conexão no Laravel
Verifique:
1. MySQL está rodando
2. Credenciais no `.env` estão corretas
3. O banco `marudimountain` existe

```bash
php artisan config:clear
php artisan cache:clear
```

---

## 📞 PRÓXIMOS PASSOS

Após criar o banco:

1. ✅ Configure o `.env`
2. ✅ Faça login com admin@marudimountain.com
3. ✅ Altere a senha do admin
4. ✅ Cadastre os primeiros produtos
5. ✅ Abra um período de vendas
6. ✅ Comece a usar o sistema!

