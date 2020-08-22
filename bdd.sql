-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ago 22, 2020 alle 17:45
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
-- Database: `bdd_1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(11) NOT NULL,
  `titolo_blog` varchar(100) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `sfondo` varchar(255) NOT NULL,
  `font` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `blog`
--

INSERT INTO `blog` (`id_blog`, `titolo_blog`, `id_cat`, `id_utente`, `sfondo`, `font`) VALUES
(1, 'Gechi Carini', 1, 1, 'Null', 'NUll');

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
(1, 'Animali');

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

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id_comm`, `data_ora_comm`, `testo_comm`, `id_utente`, `id_post`) VALUES
(1, '2020-08-22 17:41:41', 'Che bel post!', 1, 1);

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

--
-- Dump dei dati per la tabella `immagine`
--

INSERT INTO `immagine` (`id_immagine`, `id_post`, `url`) VALUES
(1, 1, 'https://nationalzoo.si.edu/sites/default/files/animals/new-caledonian-giant-gecko-05.jpg'),
(2, 1, 'https://pm1.narvii.com/6788/358293c69d0abba5dabb845325c97329c41ac047v2_hq.jpg');

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

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`id_post`, `titolo_post`, `testo_post`, `data_ora_post`, `id_blog`, `id_utente`) VALUES
(1, 'Gechi della Nuova Caledonia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum porttitor ex. Integer ultrices ante in risus efficitur, sed volutpat dui bibendum. Praesent sit amet interdum mi. Integer congue laoreet diam, nec malesuada urna consectetur ut. Mauris vulputate elit ligula, et vestibulum risus lacinia a. Aenean laoreet egestas dolor, id dapibus nisi imperdiet ac. Pellentesque lectus est, molestie vitae nulla id, hendrerit ultricies metus. Donec sit amet vestibulum libero. Quisque in orci a enim aliquam ultricies. Fusce in libero quis libero euismod euismod a at sem. Fusce ut consectetur urna, aliquet blandit sem.\r\n\r\nProin sit amet est et massa sodales vulputate vel et enim. Morbi quis leo neque. Aliquam erat volutpat. Integer vehicula, arcu ut lacinia euismod, est tellus maximus justo, nec luctus tortor dui ac est. Donec volutpat facilisis diam vel dignissim. Morbi rhoncus orci eget nunc facilisis venenatis. Phasellus volutpat enim dignissim quam scelerisque tempus. In eget eleifend mauris. Donec ipsum dui, aliquam id lacus sed, molestie dictum odio. Vivamus aliquet semper dictum. Duis vehicula urna nec lectus cursus, ac efficitur purus commodo. Vestibulum iaculis lobortis urna, et luctus nulla. Maecenas cursus ligula nec erat gravida, id malesuada tortor commodo.', '2020-08-03 17:40:56', 1, 1),
(2, 'Belli i golden retriever', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum porttitor ex. Integer ultrices ante in risus efficitur, sed volutpat dui bibendum. Praesent sit amet interdum mi. Integer congue laoreet diam, nec malesuada urna consectetur ut. Mauris vulputate elit ligula, et vestibulum risus lacinia a. Aenean laoreet egestas dolor, id dapibus nisi imperdiet ac. Pellentesque lectus est, molestie vitae nulla id, hendrerit ultricies metus. Donec sit amet vestibulum libero. Quisque in orci a enim aliquam ultricies. Fusce in libero quis libero euismod euismod a at sem. Fusce ut consectetur urna, aliquet blandit sem.\r\n\r\nProin sit amet est et massa sodales vulputate vel et enim. Morbi quis leo neque. Aliquam erat volutpat. Integer vehicula, arcu ut lacinia euismod, est tellus maximus justo, nec luctus tortor dui ac est. Donec volutpat facilisis diam vel dignissim. Morbi rhoncus orci eget nunc facilisis venenatis. Phasellus volutpat enim dignissim quam scelerisque tempus. In eget eleifend mauris. Donec ipsum dui, aliquam id lacus sed, molestie dictum odio. Vivamus aliquet semper dictum. Duis vehicula urna nec lectus cursus, ac efficitur purus commodo. Vestibulum iaculis lobortis urna, et luctus nulla. Maecenas cursus ligula nec erat gravida, id malesuada tortor commodo.', '2020-08-21 18:24:40', 1, 1),
(3, 'Post 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum porttitor ex. Integer ultrices ante in risus efficitur, sed volutpat dui bibendum. Praesent sit amet interdum mi. Integer congue laoreet diam, nec malesuada urna consectetur ut. Mauris vulputate elit ligula, et vestibulum risus lacinia a. Aenean laoreet egestas dolor, id dapibus nisi imperdiet ac. Pellentesque lectus est, molestie vitae nulla id, hendrerit ultricies metus. Donec sit amet vestibulum libero. Quisque in orci a enim aliquam ultricies. Fusce in libero quis libero euismod euismod a at sem. Fusce ut consectetur urna, aliquet blandit sem.\r\n\r\nProin sit amet est et massa sodales vulputate vel et enim. Morbi quis leo neque. Aliquam erat volutpat. Integer vehicula, arcu ut lacinia euismod, est tellus maximus justo, nec luctus tortor dui ac est. Donec volutpat facilisis diam vel dignissim. Morbi rhoncus orci eget nunc facilisis venenatis. Phasellus volutpat enim dignissim quam scelerisque tempus. In eget eleifend mauris. Donec ipsum dui, aliquam id lacus sed, molestie dictum odio. Vivamus aliquet semper dictum. Duis vehicula urna nec lectus cursus, ac efficitur purus commodo. Vestibulum iaculis lobortis urna, et luctus nulla. Maecenas cursus ligula nec erat gravida, id malesuada tortor commodo.', '2020-08-17 17:43:35', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `sessione_utente`
--

CREATE TABLE `sessione_utente` (
  `id_sessione` varchar(255) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `nome_utente` varchar(16) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `documento` varchar(9) NOT NULL,
  `cellulare` int(10) NOT NULL,
  `premium` tinyint(1) DEFAULT 0,
  `reg_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente_registrato`
--

INSERT INTO `utente_registrato` (`id_utente`, `nome_utente`, `password`, `email`, `documento`, `cellulare`, `premium`, `reg_timestamp`) VALUES
(1, 'Sofia', '$2y$10$b3spZnCSbQ2egRAr9Ai8l.MJRVPsm1RJdCCSRrPcctUcC9fWvX1my', 'ciao2@gmail.com', 'AX12345BB', 2147483647, 0, '2020-08-22 15:39:45');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`),
  ADD UNIQUE KEY `titolo_blog` (`titolo_blog`),
  ADD KEY `id_cat` (`id_cat`),
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
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nome_utente` (`nome_utente`);

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
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `id_comm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `id_immagine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id_cat`),
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

--
-- Limiti per la tabella `co_autore`
--
ALTER TABLE `co_autore`
  ADD CONSTRAINT `co_autore_ibfk_1` FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`),
  ADD CONSTRAINT `co_autore_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

--
-- Limiti per la tabella `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

--
-- Limiti per la tabella `sessione_utente`
--
ALTER TABLE `sessione_utente`
  ADD CONSTRAINT `sessione_utente_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

--
-- Limiti per la tabella `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id_cat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
