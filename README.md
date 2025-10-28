# 🏔️ Marudi Mountain - Sistema de Gestão de Vendas

Sistema completo de gestão de vendas e clientes desenvolvido em Laravel 12 com interface moderna e responsiva.

## 📋 Sobre o Sistema

**Marudi Mountain** é uma aplicação web completa para gerenciamento de:
- Clientes (Asociados, Investidores, Outros)
- Produtos com múltiplas moedas (USD, Gold, BRL, Euro)
- Vendas com controle de períodos
- Relatórios em PDF
- Controle de usuários e permissões

## 🚀 Tecnologias Utilizadas

- **Backend:** Laravel 12.0 + PHP 8.2
- **Frontend:** Blade Templates + jQuery + DataTables
- **UI:** Sneat Admin Template (Bootstrap)
- **PDF:** DomPDF
- **Build:** Vite 7.0
- **Banco de Dados:** MySQL/MariaDB

## 📦 Requisitos do Sistema

- PHP 8.2 ou superior
- Composer
- Node.js 18 ou superior
- MySQL 5.7+ ou MariaDB 10.3+
- Extensões PHP: pdo_mysql, mbstring, openssl, fileinfo

## ⚙️ Instalação Rápida

### 1. Clone ou baixe o projeto

```bash
git clone [url-do-repositorio]
cd marudimountain
```

### 2. Instale as dependências

```bash
composer install
npm install
```

### 3. Configure o ambiente

O arquivo `.env` já foi criado. Edite as credenciais do banco:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marudimountain
DB_USERNAME=root
DB_PASSWORD=sua_senha_aqui
```

### 4. Crie o banco de dados

**Opção A - Via phpMyAdmin:**
1. Acesse http://localhost/phpmyadmin
2. Vá em "Importar"
3. Selecione `database/schema.sql`
4. Execute

**Opção B - Via linha de comando:**
```bash
mysql -u root -p < database/schema.sql
```

**Opção C - Dados de exemplo:**
```bash
# Primeiro importe o schema
mysql -u root -p < database/schema.sql
# Depois os dados de teste
mysql -u root -p marudimountain < database/dados_exemplo.sql
```

### 5. Compile os assets

```bash
npm run build
```

### 6. Inicie o servidor

```bash
php artisan serve
```

Acesse: **http://localhost:8000**

## 👤 Acesso ao Sistema

### Usuário Administrador Padrão:
- **Email:** admin@marudimountain.com
- **Senha:** admin123

⚠️ **Altere a senha após o primeiro acesso!**

### Usuários de Teste (se importou dados_exemplo.sql):
- **Vendedor:** vendedor@marudimountain.com (senha: admin123)
- **Gerente:** gerente@marudimountain.com (senha: admin123)

## 📂 Estrutura do Banco de Dados

### Arquivos SQL Disponíveis:

- **`schema.sql`** - Schema completo com todas as tabelas
- **`schema_minimo.sql`** - Apenas tabelas essenciais
- **`dados_exemplo.sql`** - Dados de teste (execute após o schema)
- **`LEIA-ME_BANCO.md`** - Guia detalhado do banco

### Tabelas Principais:

- `users` - Usuários e autenticação
- `asociados`, `investidores`, `outros` - Clientes
- `produtos` - Catálogo de produtos
- `venda` - Registro de vendas
- `abrir_encerrar_venda` - Períodos de vendas
- `empresas` - Empresas cadastradas

## 🎯 Funcionalidades

### ✅ Gestão de Clientes
- 3 categorias: Asociados, Investidores, Outros
- CRUD completo com auditoria
- Dados de contato e autorização

### ✅ Produtos
- Múltiplas moedas (USD, Gold, BRL, Euro)
- Controle de estoque
- Custos e margens

### ✅ Sistema de Vendas
- Períodos configuráveis
- Validação automática de horários
- Cálculo automático de valores

### ✅ Relatórios
- Vendas diárias (PDF)
- Vendas por período (PDF)
- Relatório de clientes (PDF)
- Exportação Excel/CSV

### ✅ Controle de Acesso
- 3 níveis: Admin, Manager, User
- Menus dinâmicos por perfil
- Auditoria completa

## 🛠️ Modo Desenvolvimento

### Terminal 1 - Backend:
```bash
php artisan serve
```

### Terminal 2 - Frontend (watch):
```bash
npm run dev
```

### Ou tudo junto (recomendado):
```bash
composer dev
```

Isso inicia: servidor + fila + logs + vite

## 📱 Interface

- **Dashboard:** Vendas do dia, totais por moeda, gráficos
- **DataTables:** Todas as listagens com exportação
- **SweetAlert2:** Notificações elegantes
- **Responsive:** Funciona em desktop, tablet e mobile

## 🔧 Comandos Úteis

```bash
# Limpar caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Verificar ambiente
php artisan about

# Ver rotas
php artisan route:list

# Testes
php artisan test
```

## 📊 Auditoria

Todas as tabelas principais possuem:
- `user_id_add` - Quem criou
- `user_id_upd` - Quem atualizou  
- `user_id_del` - Quem deletou
- `fe_add`, `fe_upd`, `fe_del` - Timestamps
- `in_estatus` - Status (ativo/inativo)

## 🌐 Idiomas

O sistema suporta:
- Português (pt) ✅ Padrão
- Espanhol (es)
- Inglês (en)

## 📄 Licença

Este projeto é proprietário. Todos os direitos reservados.

## 🆘 Suporte

Para problemas ou dúvidas:
1. Consulte `database/LEIA-ME_BANCO.md`
2. Verifique os logs em `storage/logs/`
3. Execute `php artisan about` para debug

---

**Desenvolvido com Laravel 12** 🚀
