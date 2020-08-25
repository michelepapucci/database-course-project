CREATE TABLE `blog` (
  `id_blog` int PRIMARY KEY AUTO_INCREMENT,
  `titolo_blog` varchar(100) NOT NULL,
  `id_tema` int NOT NULL,
  `id_utente` int NOT NULL,
  `sfondo` varchar(255) NOT NULL,
  `font` varchar(255) NOT NULL
);

CREATE TABLE `categoria` (
  `id_cat` int PRIMARY KEY AUTO_INCREMENT,
  `nome_cat` varchar(30) NOT NULL
);

CREATE TABLE `tema` (
  `id_tema` int PRIMARY KEY AUTO_INCREMENT,
  `nome_tema` varchar(30) NOT NULL,
  `id_cat` int NOT NULL
);

CREATE TABLE `utente_registrato` (
  `id_utente` int PRIMARY KEY AUTO_INCREMENT,
  `nome_utente` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) UNIQUE NOT NULL,
  `documento` varchar(9) NOT NULL,
  `cellulare` bigint(10) NOT NULL,
  `premium` boolean DEFAULT false,
  `data_ora_reg` timestamp NOT NULL
);

CREATE TABLE `sessione_utente` (
  `id_sessione` varchar(255) PRIMARY KEY,
  `id_utente` int NOT NULL,
  `data_ora_login` timestamp NOT NULL
);

CREATE TABLE `co_autore` (
  `id_blog` int,
  `id_utente` int,
  PRIMARY KEY (`id_blog`, `id_utente`)
);

CREATE TABLE `post` (
  `id_post` int PRIMARY KEY AUTO_INCREMENT,
  `titolo_post` varchar(100) NOT NULL,
  `testo_post` text(10000),
  `data_ora_post` datetime NOT NULL,
  `id_blog` int NOT NULL,
  `id_utente` int NOT NULL,
  `visibile` boolean DEFAULT true
);

CREATE TABLE `immagine` (
  `id_immagine` int PRIMARY KEY AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `url` varchar(255) NOT NULL
);

CREATE TABLE `commento` (
  `id_comm` int PRIMARY KEY AUTO_INCREMENT,
  `data_ora_comm` datetime NOT NULL,
  `testo_comm` text(1000) NOT NULL,
  `id_utente` int NOT NULL,
  `id_post` int NOT NULL
);

ALTER TABLE `blog` ADD FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id_tema`);

ALTER TABLE `tema` ADD FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id_cat`);

ALTER TABLE `blog` ADD FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

ALTER TABLE `co_autore` ADD FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`);

ALTER TABLE `co_autore` ADD FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

ALTER TABLE `post` ADD FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`);

ALTER TABLE `post` ADD FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

ALTER TABLE `immagine` ADD FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

ALTER TABLE `commento` ADD FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

ALTER TABLE `commento` ADD FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

ALTER TABLE `sessione_utente` ADD FOREIGN KEY (`id_utente`) REFERENCES `utente_registrato` (`id_utente`);

