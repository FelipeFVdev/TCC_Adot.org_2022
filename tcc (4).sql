-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Nov-2022 às 21:02
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE `animal` (
  `id` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `tipo_animal` varchar(100) NOT NULL,
  `nome_animal` varchar(100) DEFAULT NULL,
  `idade` varchar(30) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `raca` varchar(100) DEFAULT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `pathImagem_animal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`id`, `id_usuario`, `tipo_animal`, `nome_animal`, `idade`, `sexo`, `raca`, `descricao`, `pathImagem_animal`) VALUES
(79, 45, 'cachorro', 'bob', '10', 'Macho', 'vira lata', 'cão amavel, docil e gentil', '../img/635969265c0a7.jpg'),
(80, 45, 'cachorro', 'lulu', '4', 'Femea', 'buldogue', 'cansado', '../img/635977be08926.jpg'),
(81, 41, 'gato', 'feraaa', '1', 'Femea', 'persa', 'raivoso, porém amável', '../img/63599ec10ae8a.jpg'),
(83, 50, 'cachorro', 'king', '1', 'Macho', 'sharpei', 'um cachorro docil amigavel', '../img/6359760d067aa.jpg'),
(84, 41, 'ave', 'loro jose', '18', 'Femea', 'periquito', 'Lorem Ipsum is simply dumm', '../img/636c31560df54.jpg'),
(85, 45, 'cachorro', 'bolt', '2', 'Macho', 'shih-tzu', 'pequeno, raivoso e companheiro', '../img/635969d9952fb.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id` int(10) NOT NULL,
  `email` varchar(26) NOT NULL,
  `conteudo` text NOT NULL,
  `resposta` text DEFAULT NULL,
  `id_animal` bigint(10) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id`, `email`, `conteudo`, `resposta`, `id_animal`, `nome`) VALUES
(6, 'felipe@gmail.com', 'O animal possui os registros de vacina?', NULL, 80, 'felipe'),
(8, 'teste@.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 81, 'teste'),
(9, 'danilo@gmail.com', 'o cachorro é dócil?\r\n', NULL, 80, 'danilo'),
(10, 'felipe@gmail.com', 'o gato é de graça?', '', 81, 'felipe'),
(11, 'fernando.dog@gmail.com', 'gostaria de saber se o animal ja ficou doente\r\n', NULL, 80, 'fernando'),
(12, 'bibi@gmail.com', 'ele é docil?', NULL, 84, 'Bianca'),
(15, 'kirom@gmail.com', 'O cachorro é docil?\r\n', NULL, 83, 'Kiro'),

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `tipo` enum('USUARIO','INSTITUICAO') NOT NULL DEFAULT 'USUARIO',
  `cnpj` varchar(20) DEFAULT NULL,
  `pathImagem` text NOT NULL,
  `codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `endereco`, `telefone`, `email`, `senha`, `tipo`, `cnpj`, `pathImagem`, `codigo`) VALUES
(39, 'felipe', 'rua das dores 122', '111111111114', 'felipelol@gmail.com', '$2y$10$CL74IC6QwQQs9/7FJj9Voeutb9RM5fDQotfuSvTOSQect0JntHPeO', 'USUARIO', NULL, '', '408431'),
(41, 'adogdogs', 'rua das dores 10', '119897788331', 'adog@dogs.org', '$2y$10$IjH8T6BPKzbVXXt8LX0Uyue.dOLVv51hBX1T2S3ZM86ROKWpiS7n.', 'INSTITUICAO', '12345678912349', '../img/636c2be26e041.png', '496899'),
(45, 'catchme', 'rua dos gatos 10', '11969990003', 'cat@catchme.org', '$2y$10$CL74IC6QwQQs9/7FJj9Voeutb9RM5fDQotfuSvTOSQect0JntHPeO', 'INSTITUICAO', '12345678912345', '../img/635968dc72dcd.jpg', '0'),
(50, 'instituto ', 'Rua das rosas 100', '321321515612512', 'pets@pet.com', '$2y$10$CL74IC6QwQQs9/7FJj9Voeutb9RM5fDQotfuSvTOSQect0JntHPeO', 'INSTITUICAO', '12345678912345', '../img/635975fc68b35.png', '0'),
(52, 'teste', 'rua frei joao 200', '+55 11921321412', 'testee1@gmail.com', '$2y$10$.7IhzMzVa/KlcOfPU4OSYOr3C7.uRa93KnP3ij1Azbc6UrsE5IigW', 'USUARIO', NULL, '', '0'),
(54, 'ADOTEPETS', 'Rua das rosas 100', '321321515612512', 'adotepet@gmail.com', '$2y$10$bfQ/KMBc50Et8KlxXdzIw.I9uNKYCwuYrSbzW4TwgWGVXIekipYy2', 'INSTITUICAO', '12345678912345', '../img/6359773c5ba11.png', '0'),
(56, 'love pets ong', 'Rua das rosas 11', '11969990003', 'lovepetsong@gmail.com', '$2y$10$12imhlevGARg1zDaZZxsD.MzCkLG931BojH5e1OEyY4Gq2jRR288K', 'INSTITUICAO', '12345678912345', '../img/636fdf205df3b.png', ''),
(58, 'danilera', 'osasquera ', '11111111111111', 'gigfi321@gmail.com', '$2y$10$uoFTBbl4yCws9.J1p08a6OL1UkObTMKx8JqaG3tkjbY3WHxsyNHfK', 'USUARIO', NULL, '', '7406365ad33d49bf5e1b3ca503e01fc0');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_animal` (`id_animal`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animal`
--
ALTER TABLE `animal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID`);

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_id_animal` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
