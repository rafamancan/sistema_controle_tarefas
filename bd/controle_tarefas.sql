-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2015 at 03:08 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `controle_tarefas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tarefas`
--

CREATE TABLE IF NOT EXISTS `tarefas` (
  `PKTarefas` int(10) NOT NULL AUTO_INCREMENT,
  `tarefaNome` varchar(255) NOT NULL,
  `tarefaCriadaEm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tarefaFKTipo` int(10) NOT NULL,
  PRIMARY KEY (`PKTarefas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tarefas`
--

INSERT INTO `tarefas` (`PKTarefas`, `tarefaNome`, `tarefaCriadaEm`, `tarefaFKTipo`) VALUES
(11, 'Tarefa 1', '2015-08-10 22:07:18', 9),
(12, 'Tarefa 2', '2015-08-10 22:07:21', 9),
(13, 'Tarefa 3', '2015-08-10 22:07:27', 10),
(14, 'Tarefa 4', '2015-08-10 22:07:31', 10),
(15, 'Tarefa 5', '2015-08-10 22:07:35', 10),
(16, 'Tarefa 6', '2015-08-10 22:07:39', 11),
(17, 'Tarefa 7', '2015-08-10 22:07:42', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `PKTipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipoNome` varchar(255) NOT NULL,
  `tipoCor` varchar(255) NOT NULL,
  PRIMARY KEY (`PKTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tipos`
--

INSERT INTO `tipos` (`PKTipo`, `tipoNome`, `tipoCor`) VALUES
(9, 'Projeto 1', '0c05e8'),
(10, 'Projeto 2', 'b03cb0'),
(11, 'Projeto 3', '14e0c5');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `PKUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioLogin` varchar(255) DEFAULT NULL,
  `usuarioSenha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`PKUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`PKUsuario`, `usuarioLogin`, `usuarioSenha`) VALUES
(1, 'root', '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
