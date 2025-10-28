-- ========================================
-- DADOS DE EXEMPLO - MARUDI MOUNTAIN
-- Execute APÓS importar o schema.sql
-- ========================================

USE `marudimountain`;

-- ========================================
-- USUÁRIOS DE TESTE
-- ========================================

-- Usuário Admin (já criado no schema.sql)
-- Email: admin@marudimountain.com
-- Senha: admin123

-- Usuário Vendedor
INSERT INTO `users` (`name`, `email`, `password`, `role`, `cadastro`, `in_estatus`, `created_at`, `updated_at`) 
VALUES 
('João Vendedor', 'vendedor@marudimountain.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'outro', 'ativo', NOW(), NOW());

-- Usuário Gerente
INSERT INTO `users` (`name`, `email`, `password`, `role`, `cadastro`, `in_estatus`, `created_at`, `updated_at`) 
VALUES 
('Maria Gerente', 'gerente@marudimountain.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'manager', 'outro', 'ativo', NOW(), NOW());

-- ========================================
-- EMPRESAS
-- ========================================

INSERT INTO `empresas` (`nome`, `descricao`, `responsavel`, `email`, `telefone`, `user_id_add`, `user_id_upd`, `user_id_del`) 
VALUES 
('Marudi Mountain LTDA', 'Empresa principal', 'Leonardo Silva', 'contato@marudimountain.com', '(91) 99999-0001', 1, 1, 1),
('Associação dos Garimpeiros', 'Parceiro comercial', 'Carlos Santos', 'garimpeiros@example.com', '(91) 99999-0002', 1, 1, 1);

-- ========================================
-- PRODUCTOS
-- ========================================

INSERT INTO `produtos` (`codigo`, `nome`, `descricao`, `estoque_minimo`, `custo`, `preco_venda_brl`, `preco_venda_usd`, `preco_venda_gold`, `preco_venda_euro`, `user_id_add`, `user_id_upd`, `user_id_del`) 
VALUES 
('LOAD001', 'LOAD/CARRADA', 'Carrada completa de minério', 100, 80.00, 0.00, 100.00, 5.00, 0.00, 1, 1, 1),
('LOAD002', 'MEIA CARRADA', 'Meia carrada de minério', 100, 40.00, 0.00, 50.00, 2.50, 0.00, 1, 1, 1),
('SERV001', 'TRANSPORTE', 'Serviço de transporte', 999, 30.00, 0.00, 40.00, 2.00, 0.00, 1, 1, 1);

-- ========================================
-- ASOCIADOS
-- ========================================

INSERT INTO `asociados` (`nome`, `endereco`, `telefone`, `rampa`, `aut_nome`, `aut_telefone`, `doc_identificacao`, `associado`, `contrato`, `user_id_add`, `user_id_upd`, `user_id_del`) 
VALUES 
('José Silva dos Santos', 'Rua das Flores, 123 - Centro', '(91) 98888-0001', '1', 'Maria Silva', '(91) 98888-0002', '123.456.789-00', 'Associação A', 'CONT-2025-001', 1, 1, 1),
('Pedro Oliveira Costa', 'Av. Principal, 456 - Bairro Novo', '(91) 98888-0003', '2', 'Ana Costa', '(91) 98888-0004', '987.654.321-00', 'Associação A', 'CONT-2025-002', 1, 1, 1),
('Carlos Eduardo Rocha', 'Rua do Comércio, 789', '(91) 98888-0005', '3', 'Julia Rocha', '(91) 98888-0006', '456.789.123-00', 'Associação B', 'CONT-2025-003', 1, 1, 1);

-- ========================================
-- INVESTIDORES
-- ========================================

INSERT INTO `investidores` (`nome`, `endereco`, `telefone`, `rampa`, `aut_nome`, `aut_telefone`, `doc_identificacao`, `associado`, `contrato`, `user_id_add`, `user_id_upd`, `user_id_del`) 
VALUES 
('Mineradora Golden Star LTDA', 'Av. dos Investidores, 1000', '(11) 3333-0001', '10', 'Roberto Alves', '(11) 3333-0002', '12.345.678/0001-90', 'Investidor Master', 'INV-2025-001', 1, 1, 1),
('Consórcio Norte Mineração', 'Rua Industrial, 500', '(91) 3333-0003', '11', 'Fernanda Lima', '(91) 3333-0004', '98.765.432/0001-10', 'Investidor VIP', 'INV-2025-002', 1, 1, 1);

-- ========================================
-- OUTROS CLIENTES
-- ========================================

INSERT INTO `outros` (`nome`, `endereco`, `telefone`, `rampa`, `aut_nome`, `aut_telefone`, `doc_identificacao`, `user_id_add`, `user_id_upd`, `user_id_del`) 
VALUES 
('João da Silva (Avulso)', 'Endereço não informado', '(91) 99999-1111', '50', NULL, NULL, NULL, 1, 1, 1),
('Comercial ABC', 'Rua do Porto, 321', '(91) 99999-2222', '51', 'Paulo ABC', '(91) 99999-3333', '11.222.333/0001-44', 1, 1, 1);

-- ========================================
-- PERÍODO DE VENDAS ATIVO
-- ========================================

-- Período de vendas para hoje (ajustar datas conforme necessário)
INSERT INTO `abrir_encerrar_venda` 
(`ca_disponivel`, `fe_abrir_vendas`, `hr_abrir_vendas`, `fe_encerrar_vendas`, `hr_encerrar_vendas`, 
 `aut_associados`, `aut_investidores`, `aut_outros`, `user_id_add`, `user_id_upd`, `user_id_del`) 
VALUES 
(1000, CURDATE(), '06:00:00', CURDATE(), '23:59:59', 'on', 'on', 'on', 1, 1, 1);

-- ========================================
-- VENDAS DE EXEMPLO
-- ========================================

-- Algumas vendas do dia para aparecer no dashboard
INSERT INTO `venda` 
(`nb_cliente`, `nb_produto`, `ca_produto`, `nu_rampa`, `tp_pagamento`, `mo_total`, `aben_venda_id`, `user_id_add`, `user_id_upd`, `user_id_del`) 
VALUES 
('José Silva dos Santos', 'LOAD/CARRADA', 2, '1', 'usd', 200.00, 1, 1, 1, 1),
('José Silva dos Santos', 'LOAD/CARRADA', 1, '1', 'gold', 5.00, 1, 1, 1, 1),
('Pedro Oliveira Costa', 'LOAD/CARRADA', 3, '2', 'usd', 300.00, 1, 1, 1, 1),
('Mineradora Golden Star LTDA', 'LOAD/CARRADA', 10, '10', 'usd', 1000.00, 1, 1, 1, 1),
('Mineradora Golden Star LTDA', 'LOAD/CARRADA', 5, '10', 'gold', 25.00, 1, 1, 1, 1),
('Carlos Eduardo Rocha', 'MEIA CARRADA', 4, '3', 'usd', 200.00, 1, 1, 1, 1),
('João da Silva (Avulso)', 'LOAD/CARRADA', 1, '50', 'usd', 100.00, 1, 1, 1, 1);

-- ========================================
-- FORMAS DE PAGAMENTO
-- ========================================

INSERT INTO `forma_pagamento` (`nome`, `user_id_add`, `user_id_upd`, `user_id_del`) 
VALUES 
('Dólar (USD)', 1, 1, 1),
('Ouro (GOLD)', 1, 1, 1),
('Real (BRL)', 1, 1, 1),
('Euro (EUR)', 1, 1, 1);

-- ========================================
-- ZONAS HORÁRIAS
-- ========================================

INSERT INTO `zona_horaria` (`nome`, `descricao`, `utc_offset`, `user_id_add`, `user_id_upd`, `user_id_del`) 
VALUES 
('America/Sao_Paulo', 'Brasília (GMT-3)', '-03:00', 1, 1, 1),
('America/Manaus', 'Manaus (GMT-4)', '-04:00', 1, 1, 1),
('America/Belem', 'Belém (GMT-3)', '-03:00', 1, 1, 1);

-- ========================================
-- INFORMAÇÕES DOS DADOS INSERIDOS
-- ========================================

/*
RESUMO DOS DADOS:

USUÁRIOS (todos com senha: admin123):
- admin@marudimountain.com (Admin)
- vendedor@marudimountain.com (Vendedor)
- gerente@marudimountain.com (Gerente)

CLIENTES:
- 3 Asociados
- 2 Investidores  
- 2 Outros

PRODUTOS:
- 3 produtos cadastrados

VENDAS:
- 7 vendas de exemplo registradas hoje
- Total aproximado: $1800 USD + 30 GOLD

PERÍODO DE VENDAS:
- Ativo para hoje das 06:00 às 23:59
- Todos os tipos de clientes autorizados
*/

