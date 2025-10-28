-- ========================================
-- SISTEMA MARUDI MOUNTAIN
-- Schema SQL para MySQL/MariaDB
-- Gerado automaticamente das migrations
-- ========================================

-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS `marudimountain` 
DEFAULT CHARACTER SET utf8mb4 
DEFAULT COLLATE utf8mb4_unicode_ci;

USE `marudimountain`;

-- ========================================
-- 1. TABELA: users
-- Usuários do sistema e autenticação
-- ========================================
CREATE TABLE `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'manager', 'user') NOT NULL DEFAULT 'user',
  `cadastro` ENUM('asociado', 'investidor', 'outro') NOT NULL DEFAULT 'outro',
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `users_name_index` (`name`),
  INDEX `users_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 2. TABELA: password_reset_tokens
-- Tokens para recuperação de senha
-- ========================================
CREATE TABLE `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL PRIMARY KEY,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 3. TABELA: sessions
-- Sessões de usuários
-- ========================================
CREATE TABLE `sessions` (
  `id` VARCHAR(255) NOT NULL PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` TEXT NULL DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL,
  INDEX `sessions_user_id_index` (`user_id`),
  INDEX `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 4. TABELAS: cache e cache_locks
-- Sistema de cache do Laravel
-- ========================================
CREATE TABLE `cache` (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 5. TABELAS: jobs, job_batches, failed_jobs
-- Sistema de filas do Laravel
-- ========================================
CREATE TABLE `jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED NULL DEFAULT NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  INDEX `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
  `id` VARCHAR(255) NOT NULL PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL DEFAULT NULL,
  `cancelled_at` INT NULL DEFAULT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `uuid` VARCHAR(255) NOT NULL UNIQUE,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 6. TABELA: zona_horaria
-- Zonas horárias do sistema
-- ========================================
CREATE TABLE `zona_horaria` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL UNIQUE,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `utc_offset` VARCHAR(255) NOT NULL,
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 7. TABELA: forma_pagamento
-- Formas de pagamento disponíveis
-- ========================================
CREATE TABLE `forma_pagamento` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL UNIQUE,
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 8. TABELA: empresas
-- Empresas cadastradas no sistema
-- ========================================
CREATE TABLE `empresas` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL UNIQUE,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `responsavel` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `telefone` VARCHAR(30) NULL DEFAULT NULL,
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 9. TABELA: funcionarios
-- Funcionários vinculados a empresas
-- ========================================
CREATE TABLE `funcionarios` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `empresa_id` BIGINT UNSIGNED NOT NULL,
  `in_setor` ENUM('vendas', 'adm') NOT NULL DEFAULT 'vendas',
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 10. TABELA: asociados
-- Clientes tipo Asociados
-- ========================================
CREATE TABLE `asociados` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(150) NOT NULL,
  `endereco` VARCHAR(255) NULL DEFAULT NULL,
  `telefone` VARCHAR(30) NULL DEFAULT NULL,
  `rampa` VARCHAR(100) NULL DEFAULT NULL,
  `aut_nome` VARCHAR(150) NULL DEFAULT NULL,
  `aut_telefone` VARCHAR(30) NULL DEFAULT NULL,
  `doc_identificacao` VARCHAR(50) NULL DEFAULT NULL COMMENT 'CPF/CNPJ',
  `associado` VARCHAR(100) NULL DEFAULT NULL,
  `contrato` VARCHAR(100) NULL DEFAULT NULL,
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 11. TABELA: investidores
-- Clientes tipo Investidores
-- ========================================
CREATE TABLE `investidores` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(150) NOT NULL,
  `endereco` VARCHAR(255) NULL DEFAULT NULL,
  `telefone` VARCHAR(30) NULL DEFAULT NULL,
  `rampa` VARCHAR(100) NULL DEFAULT NULL,
  `aut_nome` VARCHAR(150) NULL DEFAULT NULL,
  `aut_telefone` VARCHAR(30) NULL DEFAULT NULL,
  `doc_identificacao` VARCHAR(50) NULL DEFAULT NULL COMMENT 'CPF/CNPJ',
  `associado` VARCHAR(100) NULL DEFAULT NULL,
  `contrato` VARCHAR(100) NULL DEFAULT NULL,
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 12. TABELA: outros
-- Clientes tipo Outros
-- ========================================
CREATE TABLE `outros` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(150) NOT NULL,
  `endereco` VARCHAR(255) NULL DEFAULT NULL,
  `telefone` VARCHAR(30) NULL DEFAULT NULL,
  `rampa` VARCHAR(100) NULL DEFAULT NULL,
  `aut_nome` VARCHAR(150) NULL DEFAULT NULL,
  `aut_telefone` VARCHAR(30) NULL DEFAULT NULL,
  `doc_identificacao` VARCHAR(50) NULL DEFAULT NULL COMMENT 'CPF/CNPJ',
  `associado` VARCHAR(100) NULL DEFAULT NULL,
  `contrato` VARCHAR(100) NULL DEFAULT NULL,
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 13. TABELA: produtos
-- Produtos disponíveis para venda
-- ========================================
CREATE TABLE `produtos` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `codigo` VARCHAR(50) NOT NULL UNIQUE COMMENT 'Código interno ou SKU',
  `nome` VARCHAR(150) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `categoria_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `marca_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `estoque_minimo` INT NOT NULL DEFAULT 99999,
  `custo` DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
  `preco_venda_brl` DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
  `preco_venda_usd` DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
  `preco_venda_gold` DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
  `preco_venda_euro` DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 14. TABELA: abrir_encerrar_venda
-- Períodos de vendas disponíveis
-- ========================================
CREATE TABLE `abrir_encerrar_venda` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ca_disponivel` INT NOT NULL DEFAULT 1,
  `fe_abrir_vendas` DATE NULL DEFAULT NULL,
  `hr_abrir_vendas` TIME NULL DEFAULT NULL,
  `fe_encerrar_vendas` DATE NULL DEFAULT NULL,
  `hr_encerrar_vendas` TIME NULL DEFAULT NULL,
  `aut_associados` ENUM('off', 'on') NOT NULL DEFAULT 'off',
  `aut_investidores` ENUM('off', 'on') NOT NULL DEFAULT 'off',
  `aut_outros` ENUM('off', 'on') NOT NULL DEFAULT 'off',
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- 15. TABELA: venda
-- Registro de vendas realizadas
-- ========================================
CREATE TABLE `venda` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nb_cliente` VARCHAR(150) NOT NULL,
  `co_cliente_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `nb_produto` VARCHAR(150) NOT NULL,
  `co_produto_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `ca_produto` INT NOT NULL DEFAULT 1,
  `nu_rampa` VARCHAR(5) NULL DEFAULT NULL,
  `tp_pagamento` VARCHAR(5) NULL DEFAULT NULL COMMENT 'usd, gold, brl, euro',
  `mo_total` DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
  `aben_venda_id` BIGINT UNSIGNED NOT NULL,
  `in_estatus` ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  `user_id_add` BIGINT UNSIGNED NOT NULL,
  `user_id_upd` BIGINT UNSIGNED NOT NULL,
  `user_id_del` BIGINT UNSIGNED NOT NULL,
  `fe_add` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`aben_venda_id`) REFERENCES `abrir_encerrar_venda` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- DADOS INICIAIS
-- ========================================

-- Usuário administrador padrão
-- Senha: admin123 (alterar após primeiro login)
INSERT INTO `users` (`name`, `email`, `password`, `role`, `cadastro`, `in_estatus`, `created_at`, `updated_at`) 
VALUES 
('Administrador', 'admin@marudimountain.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'outro', 'ativo', NOW(), NOW());

-- ========================================
-- FIM DO SCHEMA
-- ========================================

