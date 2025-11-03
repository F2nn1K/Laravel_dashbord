-- =====================================================
-- SISTEMA DE PERMISSÕES E PERFIS (ACL)
-- Execute este SQL no banco de dados marudimountain
-- =====================================================

-- 1. Tabela de Permissões (Permissions)
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nome da permissão',
  `code` varchar(100) NOT NULL UNIQUE COMMENT 'Código único (ex: admin, view-dashboard)',
  `description` text DEFAULT NULL COMMENT 'Descrição da permissão',
  `module` varchar(50) DEFAULT NULL COMMENT 'Módulo (dashboard, clientes, vendas, etc)',
  `in_estatus` enum('ativo','inativo') DEFAULT 'ativo',
  `user_id_add` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id_upd` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id_del` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_code` (`code`),
  KEY `idx_module` (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Permissões do sistema';

-- 2. Tabela de Perfis/Roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nome do perfil',
  `code` varchar(100) NOT NULL UNIQUE COMMENT 'Código único (ex: admin, manager)',
  `description` text DEFAULT NULL COMMENT 'Descrição do perfil',
  `in_estatus` enum('ativo','inativo') DEFAULT 'ativo',
  `user_id_add` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id_upd` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id_del` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Perfis de usuário';

-- 3. Tabela Pivot: Perfil <-> Permissões (role_permission)
CREATE TABLE IF NOT EXISTS `role_permission` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_role_permission` (`role_id`, `permission_id`),
  KEY `fk_role_permission_role` (`role_id`),
  KEY `fk_role_permission_permission` (`permission_id`),
  CONSTRAINT `fk_role_permission_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_role_permission_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Relacionamento Perfil-Permissão';

-- 4. Tabela Pivot: Usuário <-> Perfis (user_role)
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_role` (`user_id`, `role_id`),
  KEY `fk_user_role_user` (`user_id`),
  KEY `fk_user_role_role` (`role_id`),
  CONSTRAINT `fk_user_role_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_user_role_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Relacionamento Usuário-Perfil';

-- =====================================================
-- INSERIR PERMISSÕES INICIAIS DO SISTEMA
-- =====================================================

INSERT INTO `permissions` (`name`, `code`, `description`, `module`) VALUES
-- Dashboard
('Acesso ao Dashboard', 'view-dashboard', 'Permite visualizar o dashboard principal', 'dashboard'),

-- Clientes
('Ver Asociados', 'view-asociados', 'Permite visualizar lista de asociados', 'clientes'),
('Criar Asociados', 'create-asociados', 'Permite criar novos asociados', 'clientes'),
('Editar Asociados', 'edit-asociados', 'Permite editar asociados', 'clientes'),
('Deletar Asociados', 'delete-asociados', 'Permite deletar asociados', 'clientes'),

('Ver Investidores', 'view-investidores', 'Permite visualizar lista de investidores', 'clientes'),
('Criar Investidores', 'create-investidores', 'Permite criar novos investidores', 'clientes'),
('Editar Investidores', 'edit-investidores', 'Permite editar investidores', 'clientes'),
('Deletar Investidores', 'delete-investidores', 'Permite deletar investidores', 'clientes'),

('Ver Outros', 'view-outros', 'Permite visualizar lista de outros clientes', 'clientes'),
('Criar Outros', 'create-outros', 'Permite criar outros clientes', 'clientes'),
('Editar Outros', 'edit-outros', 'Permite editar outros clientes', 'clientes'),
('Deletar Outros', 'delete-outros', 'Permite deletar outros clientes', 'clientes'),

-- Estoque
('Ver Produtos', 'view-produtos', 'Permite visualizar lista de produtos', 'estoque'),
('Criar Produtos', 'create-produtos', 'Permite criar novos produtos', 'estoque'),
('Editar Produtos', 'edit-produtos', 'Permite editar produtos', 'estoque'),
('Deletar Produtos', 'delete-produtos', 'Permite deletar produtos', 'estoque'),

-- Vendas
('Ver Vendas', 'view-vendas', 'Permite visualizar lista de vendas', 'vendas'),
('Criar Vendas', 'create-vendas', 'Permite registrar novas vendas', 'vendas'),
('Editar Vendas', 'edit-vendas', 'Permite editar vendas', 'vendas'),
('Deletar Vendas', 'delete-vendas', 'Permite deletar vendas', 'vendas'),
('Abrir/Encerrar Caixa', 'manage-caixa', 'Permite abrir e encerrar caixa de vendas', 'vendas'),

-- Relatórios
('Ver Relatórios', 'view-relatorios', 'Permite acessar relatórios', 'relatorios'),
('Gerar Relatório Total Vendas', 'relatorio-total-vendas', 'Permite gerar relatório de vendas', 'relatorios'),
('Gerar Modelo de Gestão', 'relatorio-modelo-gestao', 'Permite gerar modelo de gestão', 'relatorios'),
('Gerar Modelo de Gestão 2', 'relatorio-modelo-gestao-2', 'Permite gerar modelo de gestão 2', 'relatorios'),

-- Admin
('Ver Usuários', 'view-usuarios', 'Permite visualizar lista de usuários', 'admin'),
('Criar Usuários', 'create-usuarios', 'Permite criar novos usuários', 'admin'),
('Editar Usuários', 'edit-usuarios', 'Permite editar usuários', 'admin'),
('Deletar Usuários', 'delete-usuarios', 'Permite deletar usuários', 'admin'),

('Ver Empresas', 'view-empresas', 'Permite visualizar lista de empresas', 'admin'),
('Criar Empresas', 'create-empresas', 'Permite criar novas empresas', 'admin'),
('Editar Empresas', 'edit-empresas', 'Permite editar empresas', 'admin'),
('Deletar Empresas', 'delete-empresas', 'Permite deletar empresas', 'admin'),

-- Configurações
('Ver Configurações', 'view-configuracoes', 'Permite acessar configurações', 'configuracoes'),
('Editar Configurações', 'edit-configuracoes', 'Permite editar configurações do sistema', 'configuracoes'),

-- Gerenciar ACL
('Gerenciar Permissões', 'manage-permissions', 'Permite gerenciar permissões do sistema', 'acl'),
('Gerenciar Perfis', 'manage-roles', 'Permite gerenciar perfis de usuário', 'acl'),
('Atribuir Permissões', 'assign-permissions', 'Permite atribuir permissões aos perfis', 'acl');

-- =====================================================
-- INSERIR PERFIS INICIAIS DO SISTEMA
-- =====================================================

INSERT INTO `roles` (`name`, `code`, `description`) VALUES
('Administrador', 'admin', 'Acesso total ao sistema'),
('Gerente', 'manager', 'Gerente com acesso a relatórios e vendas'),
('Vendedor', 'user', 'Vendedor com acesso limitado'),
('Somente Leitura', 'readonly', 'Apenas visualização, sem editar/deletar');

-- =====================================================
-- ATRIBUIR TODAS PERMISSÕES AO PERFIL ADMINISTRADOR
-- =====================================================

INSERT INTO `role_permission` (`role_id`, `permission_id`)
SELECT 
    (SELECT id FROM roles WHERE code = 'admin'),
    id 
FROM permissions;

-- =====================================================
-- PERFIL GERENTE (exemplo - ajuste conforme necessário)
-- =====================================================

INSERT INTO `role_permission` (`role_id`, `permission_id`)
SELECT 
    (SELECT id FROM roles WHERE code = 'manager'),
    id 
FROM permissions 
WHERE code IN (
    'view-dashboard',
    'view-vendas', 'create-vendas', 'edit-vendas',
    'manage-caixa',
    'view-relatorios', 'relatorio-total-vendas', 'relatorio-modelo-gestao', 'relatorio-modelo-gestao-2',
    'view-asociados', 'view-investidores', 'view-outros',
    'view-produtos'
);

-- =====================================================
-- PERFIL VENDEDOR/USER (exemplo - ajuste conforme necessário)
-- =====================================================

INSERT INTO `role_permission` (`role_id`, `permission_id`)
SELECT 
    (SELECT id FROM roles WHERE code = 'user'),
    id 
FROM permissions 
WHERE code IN (
    'view-dashboard',
    'view-vendas', 'create-vendas',
    'view-relatorios', 'relatorio-total-vendas'
);

-- =====================================================
-- ATRIBUIR PERFIL ADMIN AO USUÁRIO admin
-- =====================================================

INSERT INTO `user_role` (`user_id`, `role_id`)
SELECT 
    (SELECT id FROM users WHERE name = 'admin' LIMIT 1),
    (SELECT id FROM roles WHERE code = 'admin')
WHERE NOT EXISTS (
    SELECT 1 FROM user_role 
    WHERE user_id = (SELECT id FROM users WHERE name = 'admin' LIMIT 1)
    AND role_id = (SELECT id FROM roles WHERE code = 'admin')
);

-- =====================================================
-- FIM DO SQL - Sistema ACL Pronto!
-- =====================================================

