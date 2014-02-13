-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 30-Set-2013 às 22:38
-- Versão do servidor: 5.6.12-log
-- versão do PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `projetointegrado`
--
CREATE DATABASE IF NOT EXISTS `projetointegrado` DEFAULT CHARACTER SET latin1 COLLATE utf8_unicode_ci;
USE `projetointegrado`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `animais`
--

CREATE TABLE IF NOT EXISTS `animais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) NOT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `nome` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE IF NOT EXISTS `pessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` tinyint(4) DEFAULT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `rg_ie` varchar(15) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `endereco` text,
  `telefone` varchar(15) DEFAULT NULL,
  `contato` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `tipo`, `cpf_cnpj`, `rg_ie`, `nome`, `endereco`, `telefone`, `contato`) VALUES
(1, 0, '', '', 'Rafael', '', '19199999595', 'mesmo'),
(12, 0, '', '', 'Rafael', '', '19199999595', 'mesmo'),
(13, 0, '', '', 'Rafael', '', '19199999595', 'mesmo'),
(14, 0, '', '', 'Rafael', '', '19199999595', 'mesmo'),
(15, 0, '', '', 'Rafael', '', '19199999595', 'mesmo'),
(16, 0, '', '', 'Rafael', '', '19199999595', 'mesmo'),
(17, 0, '', '', 'Rafael', '', '19199999595', 'mesmo'),
(18, 0, '', '', 'Rafael', '', '19199999595', 'mesmo'),
(19, 0, '', '', 'Rafael', '', '19199999595', 'mesmo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` text,
  `preco` decimal(10,2) DEFAULT NULL,
  `unidade` varchar(10) DEFAULT NULL,
  `estoque` decimal(10,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `forma_pagamento` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas_produtos`
--

CREATE TABLE IF NOT EXISTS `vendas_produtos` (
  `produtos_id` int(11) NOT NULL,
  `vendas_id` int(11) NOT NULL,
  `quantidade` decimal(10,2) DEFAULT NULL,
  `preco_unitario` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`produtos_id`,`vendas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
