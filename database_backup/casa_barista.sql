-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Tempo de geração: 02/09/2026 às 19:32
-- Versão do servidor: 8.4.10
-- Versão do PHP: 8.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `casa_barista`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `job_batches`
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
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
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
-- Despejando dados para a tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ca03StQM0O5Fhjs8o8ywFMClv0vzfXGykaKnnpmI', NULL, '172.18.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', 'eyJfdG9rZW4iOiJyRWFHRTZYamFHNkhEWHFOQVllSEpSZmNMblVpVjBndGgzRnd2SW8zIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hZG1pblwvY2F0ZWdvcmlhIiwicm91dGUiOiJhZG1pbi5jYXRlZ29yaWEuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1788284285),
('PRhIWkMRf2CgwF5fP9mE2czITTfY0s9D1hQSl52t', NULL, '172.18.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', 'eyJfdG9rZW4iOiJtZEhYSmQxd0dXWHBuZ2pNWFVSQk5KVnNGYmJiUnhaSGhqNWpKdDlYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788375324),
('S40QbzxdTZyLb5eUh5pL3NDfTtVFs43PEChkyVii', NULL, '172.18.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', 'eyJfdG9rZW4iOiJaTmFEZjJMUHUyMkk3VDhLbFdTTGl2RGNRMWhRNTlaRVRIb0lqYkkwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788291825),
('u6lpYAGfkH5f0iYtUAtwRlYhl5wO91iftT6z8PWf', NULL, '172.18.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', 'eyJfdG9rZW4iOiI1QzBYZ25FWWpLb21ZRWhRWFlnbjhCbXBFcmJNSENHS0hxeWQ2RzE3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hZG1pblwvcHJvZHV0byIsInJvdXRlIjoiYWRtaW4ucHJvZHV0by5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788206633);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id_banner` int NOT NULL,
  `titulo_banner` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `imagem_banner` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `status_banner` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_banner` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_banner` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_banner`
--

INSERT INTO `tbl_banner` (`id_banner`, `titulo_banner`, `imagem_banner`, `status_banner`, `data_criacao_banner`, `data_atualizacao_banner`) VALUES
(1, 'Promoção especial de inverno', 'banner/promocao_especial_de_inverno.png', 'ATIVO', '2026-05-13 14:02:20', '2026-05-20 14:09:27'),
(2, 'Festival de cafés especiais', 'banner/festival_de_cafes_especiais.png', 'ATIVO', '2026-05-18 13:18:13', '2026-05-18 13:18:13'),
(3, 'Semana do espresso', 'banner/semana_do_espresso.png', 'INATIVO', '2026-05-18 13:18:13', '2026-06-02 14:09:21'),
(4, 'Novos doces artesanais', 'banner/novos_doces_artesanais.png', 'ATIVO', '2026-05-18 13:18:13', '2026-08-20 20:07:11'),
(5, 'Café gelado da casa', 'banner/cafe_gelado_da_casa.png', 'ATIVO', '2026-05-18 13:18:13', '2026-05-18 13:18:13'),
(6, 'Combo da tarde', 'banner/combo_da_tarde.png', 'ATIVO', '2026-05-18 13:18:13', '2026-05-18 13:18:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id_categoria` int NOT NULL,
  `nome_categoria` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `status_categoria` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_categoria` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_categoria` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id_categoria`, `nome_categoria`, `status_categoria`, `data_criacao_categoria`, `data_atualizacao_categoria`) VALUES
(1, 'CAFÉ', 'ATIVO', '2026-05-13 14:52:54', '2026-05-13 14:52:54'),
(2, 'ESPECIAIS', 'ATIVO', '2026-05-18 13:29:01', '2026-05-18 13:29:01'),
(3, 'TORTAS', 'ATIVO', '2026-05-18 13:29:01', '2026-05-18 13:29:01'),
(4, 'SANDUÍCHES', 'ATIVO', '2026-05-18 13:29:01', '2026-05-18 13:29:01'),
(5, 'CHOCOLATES', 'ATIVO', '2026-05-18 13:29:01', '2026-05-18 13:29:01'),
(6, 'PROMOÇÕES', 'ATIVO', '2026-05-18 13:29:01', '2026-05-18 13:29:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `id_cliente` int NOT NULL,
  `nome_cliente` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email_cliente` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `senha_cliente` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_cliente` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `status_cliente` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_cliente` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_cliente` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_cliente`
--

INSERT INTO `tbl_cliente` (`id_cliente`, `nome_cliente`, `email_cliente`, `senha_cliente`, `foto_cliente`, `status_cliente`, `data_criacao_cliente`, `data_atualizacao_cliente`) VALUES
(1, 'Lucas Martins', 'lucas@gmail.com', 'senha123', 'cliente/lucas_martins.png', 'ATIVO', '2026-05-13 15:11:06', '2026-05-13 15:11:06'),
(2, 'Gabriel Oliveira', 'gabriel@email.com', 'senha123', 'cliente/gabriel_oliveira.png', 'ATIVO', '2026-05-18 13:38:04', '2026-05-18 13:38:04'),
(3, 'Isabela Martins', 'isabela@email.com', 'senha123', 'cliente/isabela_martins.png', 'INATIVO', '2026-05-18 13:38:04', '2026-08-20 20:10:21'),
(4, 'Henrique Lopes', 'henrique@email.com', 'senha123', 'cliente/henrique_lopes.png', 'ATIVO', '2026-05-18 13:38:04', '2026-05-18 13:38:04'),
(5, 'Natália Ribeiro', 'natalia@email.com', 'senha123', 'cliente/natalia_ribeiro.png', 'ATIVO', '2026-05-18 13:38:04', '2026-05-18 13:38:04'),
(6, 'Thiago Pereira', 'thiago@email.com', 'senha123', 'cliente/thiago_pereira.png', 'ATIVO', '2026-05-18 13:38:04', '2026-05-18 13:38:04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_contato`
--

CREATE TABLE `tbl_contato` (
  `id_contato` int NOT NULL,
  `nome_contato` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email_contato` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone_contato` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `assunto_contato` varchar(7) COLLATE utf8mb4_general_ci NOT NULL,
  `mensagem_contato` text COLLATE utf8mb4_general_ci NOT NULL,
  `status_contato` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_contato` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_contato` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_contato`
--

INSERT INTO `tbl_contato` (`id_contato`, `nome_contato`, `email_contato`, `telefone_contato`, `assunto_contato`, `mensagem_contato`, `status_contato`, `data_criacao_contato`, `data_atualizacao_contato`) VALUES
(1, 'Mariana Souza', 'mariana@gmail.com', '(11)98888-7777', 'DÚVIDA', 'Gostaria de saber se vocês aceitam reservas para grupos.', 'NOVO', '2026-05-13 14:16:12', '2026-05-13 14:16:12'),
(2, 'Bruno Almeida', 'bruno@email.com', '11933332222', 'Reserva', 'Gostaria de reservar uma mesa para quatro pessoas no sábado.', 'NOVO', '2026-05-18 13:27:32', '2026-05-18 13:27:32'),
(3, 'Larissa Mendes', 'larissa@email.com', '11922221111', 'Pedido', 'Gostaria de saber se vocês fazem encomenda de brownies.', 'NOVO', '2026-05-18 13:27:32', '2026-05-18 13:27:32'),
(4, 'Diego Ramos', 'diego@email.com', '11911110000', 'Evento', 'Tenho interesse em realizar uma reunião pequena na cafeteria.', 'LIDO', '2026-05-18 13:27:32', '2026-05-20 14:18:17'),
(5, 'Vanessa Prado', 'vanessa@email.com', '11900009999', 'Elogio', 'Gostei muito do atendimento e da qualidade do café.', 'LIDO', '2026-05-18 13:27:32', '2026-05-18 13:27:32'),
(6, 'Eduardo Nunes', 'eduardo@email.com', '11899998888', 'Dúvida', 'Gostaria de saber quais métodos de preparo vocês oferecem.', 'NOVO', '2026-05-18 13:27:32', '2026-05-18 13:27:32');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_depoimento`
--

CREATE TABLE `tbl_depoimento` (
  `id_depoimento` int NOT NULL,
  `id_cliente` int NOT NULL,
  `titulo_depoimento` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao_depoimento` text COLLATE utf8mb4_general_ci NOT NULL,
  `nota_depoimento` int NOT NULL,
  `status_depoimento` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'PENDENTE',
  `data_criacao_depoimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_depoimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_depoimento`
--

INSERT INTO `tbl_depoimento` (`id_depoimento`, `id_cliente`, `titulo_depoimento`, `descricao_depoimento`, `nota_depoimento`, `status_depoimento`, `data_criacao_depoimento`, `data_atualizacao_depoimento`) VALUES
(1, 1, 'Excelente café', 'O café estava perfeito e o atendimento foi muito acolhedor.', 1, 'APROVADO', '2026-05-13 15:29:22', '2026-07-28 19:51:55'),
(2, 2, 'Café excelente', 'O Café Longo estava muito saboroso e o atendimento foi muito bom.', 4, 'APROVADO', '2026-05-18 13:43:10', '2026-07-28 19:45:21'),
(3, 3, 'Ambiente acolhedor', 'Gostei muito do ambiente da cafeteria e da organização do espaço.', 5, 'PENDENTE', '2026-05-18 13:43:10', '2026-07-28 17:21:03'),
(4, 4, 'Ótima torta', 'A Torta de Limão estava muito boa e combinou bem com o café.', 2, 'APROVADO', '2026-05-18 13:43:10', '2026-07-28 19:45:12'),
(5, 5, 'Bom atendimento', 'Fui bem atendida e meu pedido ficou pronto rapidamente.', 5, 'PENDENTE', '2026-05-18 13:43:10', '2026-05-18 13:43:10'),
(6, 6, 'Voltarei mais vezes', 'Gostei bastante dos produtos e pretendo voltar com minha família.', 4, 'PENDENTE', '2026-05-18 13:43:10', '2026-05-18 13:43:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_galeria`
--

CREATE TABLE `tbl_galeria` (
  `id_galeria` int NOT NULL,
  `nome_galeria` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `imagem_galeria` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `status_galeria` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_galeria` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_galeria` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_galeria`
--

INSERT INTO `tbl_galeria` (`id_galeria`, `nome_galeria`, `imagem_galeria`, `status_galeria`, `data_criacao_galeria`, `data_atualizacao_galeria`) VALUES
(1, 'Ambiente Interno', 'galeria/ambiente_interno.png', 'ATIVO', '2026-05-13 14:26:45', '2026-05-13 14:26:45'),
(2, 'Barista preparando café', 'galeria/barista_preparando_cafe.png', 'ATIVO', '2026-05-18 13:18:59', '2026-05-18 13:18:59'),
(3, 'Mesa com cappuccino', 'galeria/mesa_com_cappuccino.png', 'ATIVO', '2026-05-18 13:18:59', '2026-05-18 13:18:59'),
(4, 'Vitrine de doces', 'galeria/vitrine_de_doces.png', 'ATIVO', '2026-05-18 13:18:59', '2026-05-18 13:18:59'),
(5, 'Área externa', 'galeria/area_externa.png', 'INATIVO', '2026-05-18 13:18:59', '2026-08-31 17:17:36'),
(6, 'Clientes na cafeteria', 'galeria/clientes_na_cafeteria.png', 'ATIVO', '2026-05-18 13:18:59', '2026-05-18 13:18:59');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_horarios`
--

CREATE TABLE `tbl_horarios` (
  `id_horarios` int NOT NULL,
  `dia_semana_horarios` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `hora_abertura_horarios` time NOT NULL,
  `hora_fechamento_horarios` time NOT NULL,
  `observacao_horarios` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status_horarios` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_horarios` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_horarios` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_horarios`
--

INSERT INTO `tbl_horarios` (`id_horarios`, `dia_semana_horarios`, `hora_abertura_horarios`, `hora_fechamento_horarios`, `observacao_horarios`, `status_horarios`, `data_criacao_horarios`, `data_atualizacao_horarios`) VALUES
(1, 'SEGUNDA-FEIRA', '08:00:00', '20:00:00', 'Atendimento por ordem de chegada', 'ATIVO', '2026-05-13 14:47:46', '2026-05-13 14:47:46'),
(2, 'TERÇA-FEIRA', '07:30:00', '19:30:00', 'Atendimento normal de segunda-feira', 'ATIVO', '2026-05-18 13:24:39', '2026-05-18 13:24:39'),
(3, 'QUARTA-FEIRA', '07:30:00', '19:30:00', 'Atendimento normal de terça-feira', 'ATIVO', '2026-05-18 13:24:39', '2026-05-18 13:24:39'),
(4, 'QUINTA-FEIRA', '07:30:00', '19:30:00', 'Atendimento normal de quarta-feira', 'ATIVO', '2026-05-18 13:24:39', '2026-05-18 13:24:39'),
(5, 'SEXTA-FEIRA', '07:30:00', '21:00:00', 'Horário estendido de quinta-feira', 'ATIVO', '2026-05-18 13:24:39', '2026-05-18 13:24:39'),
(6, 'SÁBADO', '07:30:00', '22:00:00', 'Horário especial de sexta-feira', 'ATIVO', '2026-05-18 13:24:39', '2026-05-18 13:24:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_itens_venda`
--

CREATE TABLE `tbl_itens_venda` (
  `id_itens_venda` int NOT NULL,
  `id_venda` int NOT NULL,
  `id_produto` int NOT NULL,
  `qtde_itens_venda` double(6,2) NOT NULL,
  `valor_unit_itens_venda` double(6,2) NOT NULL,
  `subtotal_itens_venda` double(6,2) NOT NULL,
  `status_itens_venda` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'CONFIRMADO',
  `data_criacao_itens_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_itens_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_itens_venda`
--

INSERT INTO `tbl_itens_venda` (`id_itens_venda`, `id_venda`, `id_produto`, `qtde_itens_venda`, `valor_unit_itens_venda`, `subtotal_itens_venda`, `status_itens_venda`, `data_criacao_itens_venda`, `data_atualizacao_itens_venda`) VALUES
(1, 1, 1, 2.00, 13.90, 27.80, 'CONFIRMADO', '2026-05-13 17:04:33', '2026-05-13 17:04:33'),
(2, 2, 1, 2.00, 13.90, 27.80, 'CONFIRMADO', '2026-05-18 13:53:46', '2026-05-18 13:53:46'),
(3, 2, 3, 1.00, 14.90, 14.90, 'CONFIRMADO', '2026-05-18 13:53:46', '2026-05-18 13:53:46'),
(4, 3, 2, 1.00, 8.90, 8.90, 'CONFIRMADO', '2026-05-18 13:54:07', '2026-05-18 13:54:07'),
(5, 3, 4, 1.00, 16.90, 16.90, 'CONFIRMADO', '2026-05-18 13:54:07', '2026-05-18 13:54:07'),
(6, 4, 5, 2.00, 13.90, 27.80, 'CONFIRMADO', '2026-05-18 13:54:26', '2026-05-18 13:54:26'),
(7, 4, 3, 2.00, 14.90, 29.80, 'CONFIRMADO', '2026-05-18 13:54:26', '2026-05-18 13:54:26'),
(8, 5, 6, 3.00, 21.90, 65.70, 'CONFIRMADO', '2026-05-18 13:54:42', '2026-05-20 14:39:30'),
(9, 5, 1, 1.00, 13.90, 13.90, 'CONFIRMADO', '2026-05-18 13:54:42', '2026-05-18 13:54:42'),
(10, 6, 4, 2.00, 16.90, 33.80, 'CONFIRMADO', '2026-05-18 13:55:09', '2026-05-18 13:55:09'),
(11, 6, 5, 1.00, 13.90, 13.90, 'CONFIRMADO', '2026-05-18 13:55:09', '2026-05-18 13:55:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_linha_tempo`
--

CREATE TABLE `tbl_linha_tempo` (
  `id_linha_tempo` int NOT NULL,
  `titulo_linha_tempo` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ano_linha_tempo` date NOT NULL,
  `descricao_linha_tempo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status_linha_tempo` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_linha_tempo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_linha_tempo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_linha_tempo`
--

INSERT INTO `tbl_linha_tempo` (`id_linha_tempo`, `titulo_linha_tempo`, `ano_linha_tempo`, `descricao_linha_tempo`, `status_linha_tempo`, `data_criacao_linha_tempo`, `data_atualizacao_linha_tempo`) VALUES
(1, 'FUNDAÇÃO', '2001-01-01', 'A Casa do Barista iniciou suas atividades \noferencendo cafés especiais e atendimento acolhedor.', 'ATIVO', '2026-05-13 14:34:08', '2026-05-13 14:34:08'),
(2, 'Novo blend', '2006-01-01', 'A cafeteria lançou um novo blend exclusivo com grãos selecionados.', 'ATIVO', '2026-05-18 13:20:14', '2026-05-18 13:20:14'),
(3, 'Delivery', '2011-02-01', 'A Casa do Barista iniciou o atendimento por delivery para clientes da região.', 'ATIVO', '2026-05-18 13:20:39', '2026-05-18 13:20:39'),
(4, 'Novo cardápio', '2015-03-01', 'Foi lançado um novo cardápio com cafés, doces, salgados e bebidas geladas.', 'ATIVO', '2026-05-18 13:20:39', '2026-05-18 13:20:39'),
(5, 'Curso de barista', '2021-04-01', 'A cafeteria começou a oferecer pequenos workshops sobre preparo de café.', 'ATIVO', '2026-05-18 13:20:39', '2026-05-18 13:20:39'),
(6, 'Cartão fidelidade', '2026-05-01', 'Foi criado um cartão fidelidade para clientes frequentes da cafeteria.', 'ATIVO', '2026-05-18 13:20:39', '2026-05-18 13:20:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id_news` int NOT NULL,
  `email_news` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `aceite_news` int NOT NULL DEFAULT '1',
  `data_criacao_news` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_news` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_news`
--

INSERT INTO `tbl_news` (`id_news`, `email_news`, `aceite_news`, `data_criacao_news`, `data_atualizacao_news`) VALUES
(1, 'pedro@gmail.com', 1, '2026-05-13 14:20:54', '2026-05-13 14:20:54'),
(2, 'newsletter01@email.com', 1, '2026-05-18 13:18:31', '2026-05-18 13:18:31'),
(3, 'newsletter02@email.com', 1, '2026-05-18 13:18:31', '2026-05-18 13:18:31'),
(4, 'newsletter03@email.com', 1, '2026-05-18 13:18:31', '2026-05-18 13:18:31'),
(5, 'newsletter04@email.com', 0, '2026-05-18 13:18:31', '2026-05-18 13:18:31'),
(6, 'newsletter05@email.com', 1, '2026-05-18 13:18:31', '2026-05-18 13:18:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_produto`
--

CREATE TABLE `tbl_produto` (
  `id_produto` int NOT NULL,
  `nome_produto` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `id_categoria` int NOT NULL,
  `descricao_curta_produto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao_longa_produto` text COLLATE utf8mb4_general_ci,
  `valor_produto` double(6,2) NOT NULL,
  `imagem_produto` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `destaque_produto` int NOT NULL DEFAULT '0',
  `status_produto` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_produto` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_produto` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_produto`
--

INSERT INTO `tbl_produto` (`id_produto`, `nome_produto`, `id_categoria`, `descricao_curta_produto`, `descricao_longa_produto`, `valor_produto`, `imagem_produto`, `destaque_produto`, `status_produto`, `data_criacao_produto`, `data_atualizacao_produto`) VALUES
(1, 'Café Longo', 1, 'Café longo feito no coador.', 'Café Gourmet das montanhas \nfrias do monte Centro Oeste.', 13.90, 'produto/cafe_longo.png', 1, 'ATIVO', '2026-05-13 15:00:59', '2026-05-13 15:00:59'),
(2, 'Café Longo Espresso', 1, 'Café longo suave.', 'Café longo preparado com grãos selecionados, ideal para quem prefere uma bebida mais suave.', 8.90, 'produto/cafe_longo_espresso.png', 1, 'ATIVO', '2026-05-18 13:33:15', '2026-07-30 19:24:43'),
(3, 'Torta de Limão', 3, 'Torta doce e cremosa.', 'Torta de limão com massa crocante, creme suave e cobertura especial.', 14.90, 'produto/torta_de_limao.png', 1, 'ATIVO', '2026-05-18 13:33:15', '2026-05-18 13:33:15'),
(4, 'Sanduíche Natural', 6, 'Sanduíche leve e fresco.', 'Sanduíche natural preparado com pão integral, frango desfiado, cenoura e creme especial.', 16.90, 'produto/sanduiche_natural.png', 0, 'ATIVO', '2026-05-18 13:33:15', '2026-07-30 19:25:32'),
(5, 'Chocolate Quente', 6, 'Chocolate quente cremoso.', 'Bebida quente feita com chocolate cremoso, leite vaporizado e toque especial da casa.', 13.90, 'produto/chocolate_quente.png', 1, 'ATIVO', '2026-05-18 13:33:15', '2026-07-30 19:25:26'),
(6, 'Combo Café e Torta', 6, 'Café longo com torta.', 'Combo promocional com uma unidade de Café Longo e uma fatia de Torta de Limão.', 21.90, 'produto/combo_cafe_e_torta.png', 1, 'ATIVO', '2026-05-18 13:33:15', '2026-05-18 13:33:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuarios` int NOT NULL,
  `nome_usuarios` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email_usuarios` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `senha_usuarios` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_usuarios` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `nivel_usuarios` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `status_usuarios` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_usuarios` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_usuarios` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuarios`, `nome_usuarios`, `email_usuarios`, `senha_usuarios`, `foto_usuarios`, `nivel_usuarios`, `status_usuarios`, `data_criacao_usuarios`, `data_atualizacao_usuarios`) VALUES
(1, 'Pedro da Silva', 'pedro@casadobarista.com.br', 'senha123', 'usuario/pedro_da_silva.jpg', 'ADMINISTRADOR', 'ATIVO', '2026-05-13 15:06:08', '2026-05-13 15:06:08'),
(2, 'Carla Silva', 'carla@casadobarista.com.br', 'senha123', 'usuario/carla_silva.png', 'GERENTE', 'ATIVO', '2026-05-18 13:35:19', '2026-05-18 13:38:59'),
(3, 'Marcos Renato', 'marcos@casadobarista.com.br', 'senha123', 'usuario/marcos_renato.png', 'ATENDENTE', 'ATIVO', '2026-05-18 13:35:19', '2026-05-18 13:39:15'),
(4, 'Beatriz Costa', 'beatriz@casadobarista.com.br', 'senha123', 'usuario/beatriz_costa.png', 'CAIXA', 'ATIVO', '2026-05-18 13:35:19', '2026-05-18 13:39:31'),
(5, 'Felipe Souza', 'felipe@casadobarista.com.br', 'senha123', 'usuario/felipe_souza.png', 'BARISTA', 'ATIVO', '2026-05-18 13:35:19', '2026-05-18 13:39:45'),
(6, 'Renata Pereira', 'renata@casadobarista.com.br', 'senha123', 'usuario/renata_pereira.png', 'ATENDENTE', 'ATIVO', '2026-05-18 13:35:19', '2026-05-18 13:39:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_usuarios_venda`
--

CREATE TABLE `tbl_usuarios_venda` (
  `id_usuarios_venda` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_venda` int NOT NULL,
  `data_criacao_usuarios_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_usuarios_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_usuarios_venda`
--

INSERT INTO `tbl_usuarios_venda` (`id_usuarios_venda`, `id_usuario`, `id_venda`, `data_criacao_usuarios_venda`, `data_atualizacao_usuarios_venda`) VALUES
(1, 1, 1, '2026-05-13 16:39:34', '2026-05-13 16:39:34'),
(2, 2, 2, '2026-05-18 13:49:39', '2026-05-18 13:49:39'),
(3, 3, 3, '2026-05-18 13:49:39', '2026-05-18 13:49:39'),
(4, 4, 4, '2026-05-18 13:49:39', '2026-05-18 13:49:39'),
(5, 5, 5, '2026-05-18 13:49:39', '2026-05-18 13:49:39'),
(6, 6, 6, '2026-05-18 13:49:39', '2026-05-18 13:49:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_venda`
--

CREATE TABLE `tbl_venda` (
  `id_venda` int NOT NULL,
  `data_hora_venda` datetime NOT NULL,
  `valor_total_venda` double(10,2) NOT NULL,
  `forma_pagamento_venda` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `id_cliente` int NOT NULL,
  `status_venda` varchar(12) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'EM ANDAMENTO',
  `observacao_venda` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_venda`
--

INSERT INTO `tbl_venda` (`id_venda`, `data_hora_venda`, `valor_total_venda`, `forma_pagamento_venda`, `id_cliente`, `status_venda`, `observacao_venda`, `data_criacao_venda`, `data_atualizacao_venda`) VALUES
(1, '2026-05-13 16:35:32', 27.80, 'DÉBITO', 1, 'FINALIZADA', 'Está na mesa 27.', '2026-05-13 16:35:32', '2026-05-13 17:18:47'),
(2, '2026-05-18 09:10:00', 42.70, 'DÉBITO', 2, 'FINALIZADA', 'Venda aguardando inclusão dos itens', '2026-05-18 13:47:07', '2026-05-18 13:53:46'),
(3, '2026-05-18 10:25:00', 25.80, 'CRÉDITO', 3, 'FINALIZADA', 'Venda aguardando inclusão dos itens', '2026-05-18 13:47:07', '2026-05-20 14:26:00'),
(4, '2026-05-18 12:40:00', 57.60, 'CRÉDITO', 4, 'FINALIZADA', 'Venda aguardando inclusão dos itens', '2026-05-18 13:47:07', '2026-05-18 13:54:26'),
(5, '2026-05-18 15:05:00', 35.80, 'DINHEIRO', 5, 'FINALIZADA', 'Venda aguardando inclusão dos itens', '2026-05-18 13:47:07', '2026-05-18 13:54:42'),
(6, '2026-05-18 17:30:00', 47.70, 'PIX', 6, 'FINALIZADA', 'Venda aguardando inclusão dos itens', '2026-05-18 13:47:07', '2026-05-18 13:55:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Índices de tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email_cliente` (`email_cliente`);

--
-- Índices de tabela `tbl_contato`
--
ALTER TABLE `tbl_contato`
  ADD PRIMARY KEY (`id_contato`);

--
-- Índices de tabela `tbl_depoimento`
--
ALTER TABLE `tbl_depoimento`
  ADD PRIMARY KEY (`id_depoimento`),
  ADD KEY `fk_depoimento_cliente` (`id_cliente`);

--
-- Índices de tabela `tbl_galeria`
--
ALTER TABLE `tbl_galeria`
  ADD PRIMARY KEY (`id_galeria`);

--
-- Índices de tabela `tbl_horarios`
--
ALTER TABLE `tbl_horarios`
  ADD PRIMARY KEY (`id_horarios`);

--
-- Índices de tabela `tbl_itens_venda`
--
ALTER TABLE `tbl_itens_venda`
  ADD PRIMARY KEY (`id_itens_venda`),
  ADD KEY `fk_itens_venda_venda` (`id_venda`),
  ADD KEY `fk_itens_venda_produto` (`id_produto`);

--
-- Índices de tabela `tbl_linha_tempo`
--
ALTER TABLE `tbl_linha_tempo`
  ADD PRIMARY KEY (`id_linha_tempo`);

--
-- Índices de tabela `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id_news`),
  ADD UNIQUE KEY `email_news` (`email_news`);

--
-- Índices de tabela `tbl_produto`
--
ALTER TABLE `tbl_produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_produto_categoria` (`id_categoria`);

--
-- Índices de tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuarios`),
  ADD UNIQUE KEY `email_usuarios` (`email_usuarios`);

--
-- Índices de tabela `tbl_usuarios_venda`
--
ALTER TABLE `tbl_usuarios_venda`
  ADD PRIMARY KEY (`id_usuarios_venda`),
  ADD KEY `fk_usuarios_venda_usuario` (`id_usuario`),
  ADD KEY `fk_usuarios_venda_venda` (`id_venda`);

--
-- Índices de tabela `tbl_venda`
--
ALTER TABLE `tbl_venda`
  ADD PRIMARY KEY (`id_venda`),
  ADD KEY `fk_venda_cliente` (`id_cliente`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id_banner` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_contato`
--
ALTER TABLE `tbl_contato`
  MODIFY `id_contato` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_depoimento`
--
ALTER TABLE `tbl_depoimento`
  MODIFY `id_depoimento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_galeria`
--
ALTER TABLE `tbl_galeria`
  MODIFY `id_galeria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_horarios`
--
ALTER TABLE `tbl_horarios`
  MODIFY `id_horarios` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_itens_venda`
--
ALTER TABLE `tbl_itens_venda`
  MODIFY `id_itens_venda` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tbl_linha_tempo`
--
ALTER TABLE `tbl_linha_tempo`
  MODIFY `id_linha_tempo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id_news` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_produto`
--
ALTER TABLE `tbl_produto`
  MODIFY `id_produto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuarios` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_usuarios_venda`
--
ALTER TABLE `tbl_usuarios_venda`
  MODIFY `id_usuarios_venda` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_venda`
--
ALTER TABLE `tbl_venda`
  MODIFY `id_venda` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbl_depoimento`
--
ALTER TABLE `tbl_depoimento`
  ADD CONSTRAINT `fk_depoimento_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`);

--
-- Restrições para tabelas `tbl_itens_venda`
--
ALTER TABLE `tbl_itens_venda`
  ADD CONSTRAINT `fk_itens_venda_produto` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`),
  ADD CONSTRAINT `fk_itens_venda_venda` FOREIGN KEY (`id_venda`) REFERENCES `tbl_venda` (`id_venda`);

--
-- Restrições para tabelas `tbl_produto`
--
ALTER TABLE `tbl_produto`
  ADD CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id_categoria`);

--
-- Restrições para tabelas `tbl_usuarios_venda`
--
ALTER TABLE `tbl_usuarios_venda`
  ADD CONSTRAINT `fk_usuarios_venda_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuarios`),
  ADD CONSTRAINT `fk_usuarios_venda_venda` FOREIGN KEY (`id_venda`) REFERENCES `tbl_venda` (`id_venda`);

--
-- Restrições para tabelas `tbl_venda`
--
ALTER TABLE `tbl_venda`
  ADD CONSTRAINT `fk_venda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
