-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-10-2025 a las 18:51:51
-- Versión del servidor: 8.0.43-0ubuntu0.24.04.2
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u665506188_vendasapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abrir_encerrar_venda`
--

CREATE TABLE `abrir_encerrar_venda` (
  `id` bigint UNSIGNED NOT NULL,
  `ca_disponivel` int NOT NULL DEFAULT '1',
  `fe_abrir_vendas` date DEFAULT NULL,
  `hr_abrir_vendas` time DEFAULT NULL,
  `fe_encerrar_vendas` date DEFAULT NULL,
  `hr_encerrar_vendas` time DEFAULT NULL,
  `aut_associados` enum('off','on') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `aut_investidores` enum('off','on') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `aut_outros` enum('off','on') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `abrir_encerrar_venda`
--

INSERT INTO `abrir_encerrar_venda` (`id`, `ca_disponivel`, `fe_abrir_vendas`, `hr_abrir_vendas`, `fe_encerrar_vendas`, `hr_encerrar_vendas`, `aut_associados`, `aut_investidores`, `aut_outros`, `in_estatus`, `user_id_add`, `user_id_upd`, `user_id_del`, `fe_add`, `fe_upd`, `fe_del`) VALUES
(8, 1, '2025-10-18', '11:17:00', '2025-10-18', '11:17:00', 'on', 'on', 'on', 'ativo', 1, 1, 1, '2025-10-18 11:14:14', '2025-10-18 11:14:14', '2025-10-18 11:14:14'),
(9, 1, '2025-10-20', '06:00:00', '2025-10-20', '22:00:00', 'on', 'on', 'on', 'ativo', 1, 1, 1, '2025-10-20 09:35:29', '2025-10-20 09:35:29', '2025-10-20 09:35:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asociados`
--

CREATE TABLE `asociados` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rampa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aut_nome` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aut_telefone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_identificacao` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `associado` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrato` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asociados`
--

INSERT INTO `asociados` (`id`, `nome`, `endereco`, `telefone`, `rampa`, `aut_nome`, `aut_telefone`, `doc_identificacao`, `associado`, `contrato`, `in_estatus`, `user_id_add`, `user_id_upd`, `user_id_del`, `fe_add`, `fe_upd`, `fe_del`) VALUES
(1, 'asociado 1', 'asociado 1', '95991142063', '4', 'Elvis Jose Gamboa Machado', '95991142063', NULL, '8', NULL, 'ativo', 1, 1, 1, '2025-10-16 12:38:49', '2025-10-16 12:38:49', '2025-10-16 12:38:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsavel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nome`, `descricao`, `responsavel`, `email`, `telefone`, `in_estatus`, `user_id_add`, `user_id_upd`, `user_id_del`, `fe_add`, `fe_upd`, `fe_del`) VALUES
(1, 'Marudi Mountain', 'empresa', 'Elvis Machado', 'gamboamej@gmail.com', '+5595991142063', 'ativo', 1, 1, 1, '2025-10-16 08:35:14', '2025-10-16 08:35:14', '2025-10-16 08:35:14'),
(2, 'Pratapo', 'Pratapo', 'Elvis Gamboa', 'gamboamej1@gmail.com', '12345', 'ativo', 1, 1, 1, '2025-10-16 08:53:02', '2025-10-16 08:53:02', '2025-10-16 08:53:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pagamento`
--

CREATE TABLE `forma_pagamento` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `empresa_id` bigint UNSIGNED NOT NULL,
  `in_setor` enum('vendas','adm') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vendas',
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `user_id`, `empresa_id`, `in_setor`, `in_estatus`, `user_id_add`, `user_id_upd`, `user_id_del`, `fe_add`, `fe_upd`, `fe_del`) VALUES
(1, 1, 1, 'vendas', 'ativo', 1, 1, 1, '2025-10-25 23:54:21', '2025-10-25 23:54:21', '2025-10-25 23:54:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `investidores`
--

CREATE TABLE `investidores` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rampa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aut_nome` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aut_telefone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_identificacao` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `associado` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrato` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '0001_01_01_000003_create_zona_horaria_table', 1),
(5, '0001_01_01_000004_create_forma_pagamento_table', 1),
(6, '0001_01_01_000005_create_empresa_table', 1),
(7, '2025_10_04_213448_create_asociados_table', 1),
(8, '2025_10_04_213448_create_investidores_table', 1),
(9, '2025_10_04_213448_create_outros_table', 1),
(10, '2025_10_05_202231_create_produtos_table', 1),
(11, '2025_10_07_030209_create_abrir_encerrar_venda_table', 1),
(12, '2025_10_08_231929_create_venda_table', 1),
(13, '0001_01_01_000006_create_funcionario_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `outros`
--

CREATE TABLE `outros` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rampa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aut_nome` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aut_telefone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_identificacao` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `associado` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrato` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `outros`
--

INSERT INTO `outros` (`id`, `nome`, `endereco`, `telefone`, `rampa`, `aut_nome`, `aut_telefone`, `doc_identificacao`, `associado`, `contrato`, `in_estatus`, `user_id_add`, `user_id_upd`, `user_id_del`, `fe_add`, `fe_upd`, `fe_del`) VALUES
(1, 'outro 1', 'outro 1', '95991142063', '4', 'outro 1', '95991142063', NULL, 'outro 1', NULL, 'ativo', 1, 1, 1, '2025-10-16 12:40:18', '2025-10-16 12:40:18', '2025-10-16 12:40:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produtos`
--

CREATE TABLE `produtos` (
  `id` bigint UNSIGNED NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Código interno o SKU',
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `categoria_id` bigint UNSIGNED DEFAULT NULL,
  `marca_id` bigint UNSIGNED DEFAULT NULL,
  `estoque_minimo` int NOT NULL DEFAULT '99999',
  `custo` decimal(15,2) NOT NULL DEFAULT '0.00',
  `preco_venda_brl` decimal(15,2) NOT NULL DEFAULT '0.00',
  `preco_venda_usd` decimal(15,2) NOT NULL DEFAULT '0.00',
  `preco_venda_gold` decimal(15,2) NOT NULL DEFAULT '0.00',
  `preco_venda_euro` decimal(15,2) NOT NULL DEFAULT '0.00',
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `produtos`
--

INSERT INTO `produtos` (`id`, `codigo`, `nome`, `descricao`, `categoria_id`, `marca_id`, `estoque_minimo`, `custo`, `preco_venda_brl`, `preco_venda_usd`, `preco_venda_gold`, `preco_venda_euro`, `in_estatus`, `user_id_add`, `user_id_upd`, `user_id_del`, `fe_add`, `fe_upd`, `fe_del`) VALUES
(1, '4234', 'LOAD/CARRADA', 'carga que um carro transporta ou pode transportar de uma só vez.', 1, 1, 99999, 1.01, 100.00, 100.00, 0.30, 15.00, 'ativo', 1, 1, 1, '2025-10-18 08:32:31', '2025-10-20 09:35:29', '2025-10-20 09:35:29'),
(2, '69309410', 'Elvis Jose Gamboa Machado', 'dfb', NULL, NULL, 3, 3.00, 3.00, 12.00, 3.00, 0.00, 'ativo', 1, 1, 1, '2025-10-18 08:40:11', '2025-10-18 08:42:50', '2025-10-18 08:42:50'),
(3, '693094102', 'sadsa', 'asd', NULL, NULL, 4, 0.03, 0.06, 0.02, 0.02, 0.00, 'ativo', 1, 1, 1, '2025-10-19 23:12:02', '2025-10-19 23:12:02', '2025-10-19 23:12:02'),
(4, '6930941055', 'Análisis de laboratorio', 'rtyrty', NULL, NULL, 1, 0.02, 0.00, 100.00, 0.04, 0.00, 'ativo', 1, 1, 1, '2025-10-19 23:17:12', '2025-10-19 23:17:12', '2025-10-19 23:17:12'),
(5, '605045', 'Análisis de laboratorio', '345435435', NULL, NULL, 1, 1.00, 0.00, 100.00, 0.08, 0.00, 'ativo', 1, 1, 1, '2025-10-19 23:34:07', '2025-10-19 23:34:07', '2025-10-19 23:34:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1HfN6kajCpG34Q20bsaEwmFnYXiT1GHJNaYF6vv8', NULL, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkR6dGxlUHhEVkx0Y3BOdkpYQWxHUTk0bkVHaGdQbGxGbkhnM0VNaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjQ6Imh0dHA6Ly9sb2NhbGhvc3QvcGhwL2x2bDEyL21hcnVkaW1vdW50YWluL3B1YmxpYy9pbmRleC5waHAvbG9naW4iO319', 1761587346);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','manager','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `cadastro` enum('asociado','investidor','outro') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'outro',
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `cadastro`, `in_estatus`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@vsamining.com.br', '2025-10-06 00:00:00', '$2y$12$kmVGVrTn1hfnkojmvAnb4.MR7rRTLS3e3Eh9yi89kffwZKJkjvNaO', 'admin', 'outro', 'ativo', NULL, '2025-10-06 00:00:00', '2025-10-06 00:00:00'),
(2, 'Antonio Jose de Souza Ferreira', 'ajsouferre@gmail.com', NULL, '$2y$12$snqnj4eD1wElW6c4EtgxtOMi9JwGZV4c4IehGQi9SnMzTZMrqG4ya', 'admin', 'outro', 'ativo', NULL, NULL, NULL),
(3, 'Elvis Machado', 'gamboamej@gmail.com', '2025-10-12 08:00:00', '$2y$12$kmVGVrTn1hfnkojmvAnb4.MR7rRTLS3e3Eh9yi89kffwZKJkjvNaO', 'admin', 'outro', 'ativo', NULL, '2025-10-12 08:00:00', '2025-10-12 08:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venda`
--

CREATE TABLE `venda` (
  `id` bigint UNSIGNED NOT NULL,
  `nb_cliente` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `co_cliente_id` bigint UNSIGNED DEFAULT NULL,
  `nb_produto` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `co_produto_id` bigint UNSIGNED DEFAULT NULL,
  `ca_produto` int NOT NULL DEFAULT '1',
  `nu_rampa` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_pagamento` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mo_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `aben_venda_id` bigint UNSIGNED NOT NULL,
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `venda`
--

INSERT INTO `venda` (`id`, `nb_cliente`, `co_cliente_id`, `nb_produto`, `co_produto_id`, `ca_produto`, `nu_rampa`, `tp_pagamento`, `mo_total`, `aben_venda_id`, `in_estatus`, `user_id_add`, `user_id_upd`, `user_id_del`, `fe_add`, `fe_upd`, `fe_del`) VALUES
(1, 'joao', NULL, '1', NULL, 1, '1', 'usd', 100.00, 9, 'ativo', 1, 1, 1, '2025-10-20 09:35:43', '2025-10-20 09:35:43', '2025-10-20 09:35:43'),
(2, 'pedro', NULL, 'LOAD/CARRADA', NULL, 1, '2', 'usd', 100.00, 9, 'ativo', 1, 1, 1, '2025-10-20 10:07:04', '2025-10-20 10:07:04', '2025-10-20 10:07:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona_horaria`
--

CREATE TABLE `zona_horaria` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utc_offset` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_estatus` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `user_id_add` bigint UNSIGNED NOT NULL,
  `user_id_upd` bigint UNSIGNED NOT NULL,
  `user_id_del` bigint UNSIGNED NOT NULL,
  `fe_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_del` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abrir_encerrar_venda`
--
ALTER TABLE `abrir_encerrar_venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abrir_encerrar_venda_user_id_add_foreign` (`user_id_add`),
  ADD KEY `abrir_encerrar_venda_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `abrir_encerrar_venda_user_id_del_foreign` (`user_id_del`);

--
-- Indices de la tabla `asociados`
--
ALTER TABLE `asociados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asociados_user_id_add_foreign` (`user_id_add`),
  ADD KEY `asociados_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `asociados_user_id_del_foreign` (`user_id_del`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empresas_nome_unique` (`nome`),
  ADD UNIQUE KEY `empresas_email_unique` (`email`),
  ADD KEY `empresas_user_id_add_foreign` (`user_id_add`),
  ADD KEY `empresas_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `empresas_user_id_del_foreign` (`user_id_del`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `forma_pagamento_nome_unique` (`nome`),
  ADD KEY `forma_pagamento_user_id_add_foreign` (`user_id_add`),
  ADD KEY `forma_pagamento_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `forma_pagamento_user_id_del_foreign` (`user_id_del`);

--
-- Indices de la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionarios_user_id_foreign` (`user_id`),
  ADD KEY `funcionarios_empresa_id_foreign` (`empresa_id`),
  ADD KEY `funcionarios_user_id_add_foreign` (`user_id_add`),
  ADD KEY `funcionarios_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `funcionarios_user_id_del_foreign` (`user_id_del`);

--
-- Indices de la tabla `investidores`
--
ALTER TABLE `investidores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investidores_user_id_add_foreign` (`user_id_add`),
  ADD KEY `investidores_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `investidores_user_id_del_foreign` (`user_id_del`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `outros`
--
ALTER TABLE `outros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outros_user_id_add_foreign` (`user_id_add`),
  ADD KEY `outros_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `outros_user_id_del_foreign` (`user_id_del`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produtos_codigo_unique` (`codigo`),
  ADD KEY `produtos_user_id_add_foreign` (`user_id_add`),
  ADD KEY `produtos_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `produtos_user_id_del_foreign` (`user_id_del`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venda_aben_venda_id_foreign` (`aben_venda_id`),
  ADD KEY `venda_user_id_add_foreign` (`user_id_add`),
  ADD KEY `venda_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `venda_user_id_del_foreign` (`user_id_del`);

--
-- Indices de la tabla `zona_horaria`
--
ALTER TABLE `zona_horaria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zona_horaria_nome_unique` (`nome`),
  ADD KEY `zona_horaria_user_id_add_foreign` (`user_id_add`),
  ADD KEY `zona_horaria_user_id_upd_foreign` (`user_id_upd`),
  ADD KEY `zona_horaria_user_id_del_foreign` (`user_id_del`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abrir_encerrar_venda`
--
ALTER TABLE `abrir_encerrar_venda`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `asociados`
--
ALTER TABLE `asociados`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `investidores`
--
ALTER TABLE `investidores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `outros`
--
ALTER TABLE `outros`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venda`
--
ALTER TABLE `venda`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `zona_horaria`
--
ALTER TABLE `zona_horaria`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abrir_encerrar_venda`
--
ALTER TABLE `abrir_encerrar_venda`
  ADD CONSTRAINT `abrir_encerrar_venda_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `abrir_encerrar_venda_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `abrir_encerrar_venda_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asociados`
--
ALTER TABLE `asociados`
  ADD CONSTRAINT `asociados_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asociados_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asociados_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `empresas_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `empresas_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `empresas_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD CONSTRAINT `forma_pagamento_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forma_pagamento_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forma_pagamento_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funcionarios_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funcionarios_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funcionarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funcionarios_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `investidores`
--
ALTER TABLE `investidores`
  ADD CONSTRAINT `investidores_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investidores_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investidores_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `outros`
--
ALTER TABLE `outros`
  ADD CONSTRAINT `outros_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `outros_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `outros_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produtos_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produtos_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_aben_venda_id_foreign` FOREIGN KEY (`aben_venda_id`) REFERENCES `abrir_encerrar_venda` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `venda_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `venda_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `venda_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `zona_horaria`
--
ALTER TABLE `zona_horaria`
  ADD CONSTRAINT `zona_horaria_user_id_add_foreign` FOREIGN KEY (`user_id_add`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `zona_horaria_user_id_del_foreign` FOREIGN KEY (`user_id_del`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `zona_horaria_user_id_upd_foreign` FOREIGN KEY (`user_id_upd`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
