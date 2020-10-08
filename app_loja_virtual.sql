-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Out-2020 às 15:33
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `app_loja_virtual`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_carrinho`
--

CREATE TABLE `tb_carrinho` (
  `id_user` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT 1,
  `id_carrinho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cartao_loja_virtual`
--

CREATE TABLE `tb_cartao_loja_virtual` (
  `id_cartão` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `login_cartao` varchar(16) NOT NULL,
  `senha_cartao` varchar(20) NOT NULL,
  `creditos` float(12,2) DEFAULT 2500.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `img` longtext NOT NULL,
  `preco` float(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id_produto`, `nome`, `data`, `img`, `preco`) VALUES
(9, 'Samsung Gálaxi S10', '2020-10-02 19:32:43', 'testeSamsung.png', 1000.00),
(10, 'Iphone X', '2020-10-02 20:53:38', 'IphoneX.png', 4999.00),
(15, 'Xaiomi Md3', '2020-10-05 11:47:25', 'XiomiMi.png', 2000.00),
(16, 'Xaiomi Md5', '2020-10-05 11:49:01', 'XiomiMi.png', 5000.50),
(17, 'Notebook Samsung', '2020-10-08 12:55:48', 'notSansung.png', 2000.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_status`
--

CREATE TABLE `tb_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `status`) VALUES
(1, 'PENDENTE'),
(2, 'COMPRADO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user_type`
--

CREATE TABLE `tb_user_type` (
  `id_type` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_user_type`
--

INSERT INTO `tb_user_type` (`id_type`, `user_type`) VALUES
(1, 'usuário'),
(2, 'administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id_user` int(11) NOT NULL,
  `id_type` int(11) NOT NULL DEFAULT 1,
  `email` varchar(250) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  ADD PRIMARY KEY (`id_carrinho`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_status` (`id_status`);

--
-- Índices para tabela `tb_cartao_loja_virtual`
--
ALTER TABLE `tb_cartao_loja_virtual`
  ADD PRIMARY KEY (`id_cartão`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Índices para tabela `tb_user_type`
--
ALTER TABLE `tb_user_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_type` (`id_type`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  MODIFY `id_carrinho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_cartao_loja_virtual`
--
ALTER TABLE `tb_cartao_loja_virtual`
  MODIFY `id_cartão` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_user_type`
--
ALTER TABLE `tb_user_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  ADD CONSTRAINT `tb_carrinho_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_usuario` (`id_user`),
  ADD CONSTRAINT `tb_carrinho_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id_produto`),
  ADD CONSTRAINT `tb_carrinho_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id_status`);

--
-- Limitadores para a tabela `tb_cartao_loja_virtual`
--
ALTER TABLE `tb_cartao_loja_virtual`
  ADD CONSTRAINT `tb_cartao_loja_virtual_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_usuario` (`id_user`);

--
-- Limitadores para a tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `tb_usuario_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `tb_user_type` (`id_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
