-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 01, 2020 alle 00:51
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdd`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(11) NOT NULL,
  `titolo_blog` varchar(100) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `sfondo` varchar(255) NOT NULL,
  `font` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `id_cat` int(11) NOT NULL,
  `nome_cat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`id_cat`, `nome_cat`) VALUES
(1, 'Anatomia'),
(2, 'Astronomia'),
(3, 'Biologia'),
(4, 'Botanica'),
(5, 'Chimica'),
(6, 'Climatologia'),
(7, 'Ecologia'),
(8, 'Fisica'),
(9, 'Fisiologia'),
(10, 'Geologia'),
(11, 'Geometria'),
(12, 'Logica'),
(13, 'Matematica'),
(14, 'Meteorologia'),
(15, 'Metrologia'),
(16, 'Paleontologia'),
(17, 'Statistica'),
(18, 'Zoologia'),
(19, 'Animazione'),
(20, 'Arte digitale'),
(21, 'Arti visive'),
(22, 'Arti performative'),
(23, 'Canto'),
(24, 'Cinema'),
(25, 'Danza'),
(26, 'Fotografia'),
(27, 'Fumetto'),
(28, 'Grafica'),
(29, 'Letteratura'),
(30, 'Musica'),
(31, 'Pittura'),
(32, 'Scultura'),
(33, 'Teatro'),
(34, 'Televisione'),
(35, 'Antropologia'),
(36, 'Archeologia'),
(37, 'Criminologia'),
(38, 'Diritto'),
(39, 'Economia'),
(40, 'Educazione'),
(41, 'Etnologia'),
(42, 'Finanza'),
(43, 'Filosofia'),
(44, 'Geografia'),
(45, 'Linguistica'),
(46, 'Mitologia'),
(47, 'Psicologia'),
(48, 'Sociologia'),
(49, 'Storia'),
(50, 'Ambiente'),
(51, 'Attività'),
(52, 'Comunicazione'),
(53, 'Eventi'),
(54, 'Hobby'),
(55, 'Mass media'),
(56, 'Moda'),
(57, 'Persone'),
(58, 'Politica'),
(59, 'Religione'),
(60, 'Salute'),
(61, 'Sport'),
(62, 'Turismo'),
(63, 'Aviazione'),
(64, 'Agricoltura'),
(65, 'Alimentazione'),
(66, 'Architettura'),
(67, 'Astronautica'),
(68, 'Costruzioni'),
(69, 'Design'),
(70, 'Edilizia'),
(71, 'Elettronica'),
(72, 'Elettrotecnica'),
(73, 'Geotecnica'),
(74, 'Idraulica'),
(75, 'Informatica'),
(76, 'Infrastrutture'),
(77, 'Ingegneria'),
(78, 'Materiali'),
(79, 'Medicina'),
(80, 'Medicina veterinaria'),
(81, 'Robotica'),
(82, 'Sistemi'),
(83, 'Standard'),
(84, 'Tecnologia'),
(85, 'Telecomunicazioni'),
(86, 'Trasporti'),
(87, 'Urbanistica');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `id_comm` int(11) NOT NULL,
  `data_ora_comm` datetime NOT NULL,
  `testo_comm` text NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `co_autore`
--

CREATE TABLE `co_autore` (
  `id_blog` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

CREATE TABLE `immagine` (
  `id_immagine` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `titolo_post` varchar(100) NOT NULL,
  `testo_post` text DEFAULT NULL,
  `data_ora_post` datetime NOT NULL,
  `id_blog` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `sessione_utente`
--

CREATE TABLE `sessione_utente` (
  `id_sessione` varchar(255) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `data_ora_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL,
  `nome_tema` varchar(30) NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente_registrato`
--

CREATE TABLE `utente_registrato` (
  `id_utente` int(11) NOT NULL,
  `nome_utente` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `documento` varchar(9) NOT NULL,
  `cellulare` varchar(10) NOT NULL,
  `data_ora_reg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`),
  ADD KEY `id_tema` (`id_tema`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`id_comm`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `co_autore`
--
ALTER TABLE `co_autore`
  ADD PRIMARY KEY (`id_blog`,`id_utente`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`id_immagine`),
  ADD KEY `id_post` (`id_post`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_blog` (`id_blog`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `sessione_utente`
--
ALTER TABLE `sessione_utente`
  ADD PRIMARY KEY (`id_sessione`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indici per le tabelle `utente_registrato`
--
ALTER TABLE `utente_registrato`
  ADD PRIMARY KEY (`id_utente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `id_comm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `id_immagine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente_registrato`
--
ALTER TABLE `utente_registrato`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id_tema`),
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`) ON DELETE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE,
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`) ON DELETE CASCADE;

--
-- Limiti per la tabella `co_autore`
--
ALTER TABLE `co_autore`
  ADD CONSTRAINT `co_autore_ibfk_1` FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE,
  ADD CONSTRAINT `co_autore_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`) ON DELETE CASCADE;

--
-- Limiti per la tabella `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`) ON DELETE CASCADE;

--
-- Limiti per la tabella `sessione_utente`
--
ALTER TABLE `sessione_utente`
  ADD CONSTRAINT `sessione_utente_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id_cat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
