-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jan-2022 às 02:47
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `desafio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `moves`
--

CREATE TABLE `moves` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `cartao` varchar(12) NOT NULL,
  `hora` time NOT NULL,
  `dono_da_loja` varchar(14) NOT NULL,
  `loja` varchar(19) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `natures`
--

CREATE TABLE `natures` (
  `id` int(11) NOT NULL,
  `nome` varchar(10) NOT NULL,
  `sinal` varchar(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `natures`
--

INSERT INTO `natures` (`id`, `nome`, `sinal`, `created_at`, `updated_at`) VALUES
(1, 'Entrada', '+', '2022-01-03 00:11:27', '2022-01-03 00:11:27'),
(2, 'Saída', '-', '2022-01-03 00:11:43', '2022-01-03 00:11:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `descricao` varchar(40) NOT NULL,
  `natureza_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `types`
--

INSERT INTO `types` (`id`, `descricao`, `natureza_id`, `created_at`, `updated_at`) VALUES
(1, 'Débito', 1, '2022-01-03 00:13:10', '2022-01-03 00:13:10'),
(2, 'Boleto', 2, '2022-01-03 00:13:10', '2022-01-03 00:13:10'),
(3, 'Financiamento', 2, '2022-01-03 00:13:10', '2022-01-03 00:13:10'),
(4, 'Crédito', 1, '2022-01-03 00:13:10', '2022-01-03 00:13:10'),
(5, 'Recebimento Empréstimo', 1, '2022-01-03 00:13:10', '2022-01-03 00:13:10'),
(6, 'Vendas', 1, '2022-01-03 00:13:10', '2022-01-03 00:13:10'),
(7, 'Recebimento TED', 1, '2022-01-03 00:13:10', '2022-01-03 00:13:10'),
(8, 'Recebimento DOC', 1, '2022-01-03 00:13:10', '2022-01-03 00:13:10'),
(9, 'Aluguel', 2, '2022-01-03 00:13:10', '2022-01-03 00:13:10');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `moves`
--
ALTER TABLE `moves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Índices para tabela `natures`
--
ALTER TABLE `natures`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `natureza_id` (`natureza_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `moves`
--
ALTER TABLE `moves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `natures`
--
ALTER TABLE `natures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `moves`
--
ALTER TABLE `moves`
  ADD CONSTRAINT `moves_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `types_ibfk_1` FOREIGN KEY (`natureza_id`) REFERENCES `natures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
