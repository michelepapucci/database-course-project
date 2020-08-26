<?php
// Definisco host, nome db, username e password.
	$dbhost = "localhost";
	$dbname = "bdd";
	$dbuser = "admin";
	$dbpsw = "password";


	/* Disattivo la modalità di simulazione per le prepared statement.
	 * Attivo gestione degli errori via eccezioni.
	 * Definisco la modalità di fetch di default con array associativi. */
	$options = [
		PDO::ATTR_EMULATE_PREPARES => false,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	];

	function db_connect()
	{
		global $dbhost, $dbname, $dbuser, $dbpsw, $options;
		// Tento la connessione al DB
		try {
			$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpsw, $options);
			return $pdo;
		} catch(PDOException $e) {
			throw new Exception("Impossibile connettersi al database!");
		}
	}

	//Cerco e restituisco un post con un certo id
	function getPost($post_id)
	{
		global $pdo;
		if($pdo != false) {
			$stmt = $pdo->prepare("SELECT id_post, titolo_post, testo_post, data_ora_post, nome_utente
											FROM post, utente_registrato AS a
											WHERE id_post = :id
											AND post.id_utente = a.id_utente");
			$stmt->bindParam(':id', $post_id);
			$stmt->execute();
			if($post = $stmt->fetch()) {
				return $post;
			}
		}
		return false;
	}

	function getImmaginiPost($post_id)
	{
		global $pdo;
		if($pdo != false) {
			$stmt = $pdo->prepare("SELECT * FROM immagine WHERE id_post = :id");
			$stmt->bindParam(':id', $post_id);
			$stmt->execute();
			if($immagini = $stmt->fetchAll()) {
				return $immagini;
			}
		}
		return false;
	}

	function getNumeroCommenti($post_id)
	{
		global $pdo;
		if($pdo != false) {
			$stmt = $pdo->prepare("SELECT COUNT(*) FROM commento WHERE id_post = :id");
			$stmt->bindParam(':id', $post_id);
			$stmt->execute();
			return $stmt->fetchColumn(0);
		}
	}

	//Cerco e restituisco tutti i commenti ad un certo post
	function getCommenti($post_id)
	{
		global $pdo;
		if($pdo != false) {
			$stmt = $pdo->prepare("
									SELECT data_ora_comm, testo_comm, nome_utente
									FROM commento, utente_registrato AS a
									WHERE id_post = :id
									AND commento.id_utente = a.id_utente ");
			$stmt->bindParam(':id', $post_id);
			$stmt->execute();
			if($commenti = $stmt->fetchAll()) {
				return $commenti;
			}
		}
		return false;
	}

	function getLatestPostSidebar($post_id)
	{
		global $pdo;
		if($pdo != false) {
			$stmt = $pdo->prepare("
							SELECT * 
							FROM post 
							WHERE id_blog = (SELECT id_blog FROM post WHERE id_post = :id) 
							ORDER BY data_ora_post DESC LIMIT 5");
			$stmt->bindParam(':id', $post_id);
			$stmt->execute();
			if($posts = $stmt->fetchAll()) {
				return $posts;
			}
		}
		return false;
	}

	function getCategorie()
	{
		global $pdo;
		if($pdo != false) {
			try {
				$stmt = $pdo->prepare("SELECT * FROM categoria");
				$stmt->execute();
				if($cat = $stmt->fetchAll()) {
					return $cat;
				}
			} catch(PDOException $e) {
				throw new Exception("Impossibile trovare categorie sul Database!");
			}
		}
	}

	function inserisciPost($titolo, $testo, $id_blog, $id_utente)
	{
		global $pdo;

		if($pdo != false) {
			try {
				$stmt = $pdo->prepare("
												INSERT INTO post(titolo_post, testo_post, data_ora_post, id_blog, id_utente)
												VALUES(:tit, :tes, NOW(), :b_id, :u_id)");
				$stmt->execute(array(':tit' => $titolo, ':tes' => $testo, ':b_id' => $id_blog, ':u_id' => $id_utente));
				return $pdo->lastInsertId();
			} catch(PDOException $e) {
				throw new Exception("Impossibile inserire il Post!");
			}
		}
		return false;
	}

	function inserisciImmaginiPost($id_post, $immagini): bool
	{
		global $pdo;
		if($pdo != false) {
			try {
				foreach($immagini as $immagine) {
					$stmt = $pdo->prepare("
												INSERT INTO immagine(id_post, url)
												VALUES (:id, :url)
					");
					$stmt->execute(array(':id' => $id_post, 'url' => $immagine));
				}
				return true;
			} catch(PDOException $e) {
				throw new Exception("Impossibile inserire le immagini nel Post!");
			}
		}
		return false;
	}

	function inserisciNuovoBlog($tit, $tema, $user, $sfondo, $font)
	{
		global $pdo;
		if($pdo != false) {
			try {
				$stmt = $pdo->prepare("
												INSERT INTO blog(titolo_blog, id_tema, id_utente, sfondo, font)
												VALUES (:tit, :tema, :user, :sfo, :font)");
				$stmt->execute(array(":tit" => $tit, ":tema" => $tema, ":user" => $user, ":sfo" => $sfondo, ":font" => $font));
				return $pdo -> lastInsertId();
			} catch(PDOException $e) {
				throw new Exception("Impossibile creare nuovo blog!");
			}
		}
		return false;
	}

	function checkPresenzaTema($tema, $id_cat)
	{
		global $pdo;
		if($pdo != false) {
			try {
				$stmt = $pdo->prepare("
												SELECT *
												FROM tema
												WHERE nome_tema = :nome
												AND id_cat = :cat");
				$stmt->execute(array(':nome' => $tema, ':cat' => $id_cat));
				if($id = $stmt->fetch()) {
					return $id["id_tema"];
				} else {
					return false;
				}
			} catch(PDOException $e) {
				throw new Exception("Errore query tema");
			}
		}
	}

	function inserisciNuovoTema($tema, $id_cat)
	{
		global $pdo;
		if($pdo != false) {
			try {
				$stmt = $pdo->prepare("
												INSERT INTO tema(nome_tema, id_cat)
												VALUES (:nome, :cat)");
				$stmt->execute(array(':nome' => $tema, ':cat' => $id_cat));
				return $pdo->lastInsertId();
			} catch(PDOException $e) {
				throw new Exception("Errore query tema");
			}
		}
		return false;
	}

	/* TODO: Aggiungere Try Catch */