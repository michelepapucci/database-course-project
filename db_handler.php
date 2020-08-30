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
			$stmt = $pdo->prepare("SELECT id_post, titolo_post, testo_post, data_ora_post, nome_utente, id_blog
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

	function getBlog($id_blog)
	{
		global $pdo;
		try {
			$stmt = $pdo->prepare("
											SELECT titolo_blog, sfondo, font, nome_cat, nome_tema, nome_utente, categoria.id_cat, blog.id_utente
											FROM blog, categoria, tema, utente_registrato
											WHERE id_blog = :id
											AND blog.id_utente = utente_registrato.id_utente
											AND categoria.id_cat = tema.id_cat
											AND tema.id_tema = blog.id_tema");
			$stmt->execute(array(':id' => $id_blog));
			if($blog = $stmt->fetch()) {
				return $blog;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			throw new Exception("Impossibile trovare il blog richiesto");
		}
	}

	function getCoautoriDiBlog($id_blog) {
		global $pdo;
		try {
			$stmt = $pdo -> prepare ("SELECT DISTINCT co_autore.id_utente
											FROM utente_registrato, co_autore, blog
											WHERE utente_registrato.id_utente = co_autore.id_utente
											AND blog.id_blog = co_autore.id_blog
											AND blog.id_blog = :id");
			$stmt -> execute(array(':id'=>$id_blog));
			return $stmt->fetchAll();
		} catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	function getPostDiBlog($id_blog)
	{
		global $pdo;
		try {
			$stmt = $pdo->prepare("SELECT * FROM post WHERE id_blog = :id ORDER BY data_ora_post DESC");
			$stmt->execute(array(':id' => $id_blog));
			$posts = $stmt->fetchAll();
			return $posts;
		} catch(PDOException $e) {
			throw new Exception("Impossibile trovare i post del blog!");
		}
	}

	function getBlogDiCategoria($id_cat)
	{
		global $pdo;
		try {
			$stmt = $pdo->prepare("
											SELECT titolo_blog, sfondo, font, nome_cat, nome_tema, nome_utente, id_blog
											FROM blog, categoria, tema, utente_registrato
											WHERE tema.id_cat = :id
											AND blog.id_utente = utente_registrato.id_utente
											AND categoria.id_cat = tema.id_cat
											AND tema.id_tema = blog.id_tema");
			$stmt->execute(array(':id' => $id_cat));
			return $stmt->fetchAll();
		} catch(PDOException $e) {
			throw new Exception("Impossibile trovare i blog nella categoria!");
		}
	}

	function getBlogUtente($id_ut)
	{
		global $pdo;
		try {
			$stmt = $pdo->prepare("(SELECT co_autore.id_blog
    										FROM blog, utente_registrato, co_autore
											WHERE blog.id_blog = co_autore.id_blog
											AND utente_registrato.id_utente = co_autore.id_utente
											AND co_autore.id_utente = :id1)
											UNION
											(SELECT id_blog 
											FROM blog
											WHERE blog.id_utente = :id2)");
			$stmt->execute(array(':id1' => $id_ut, ':id2' => $id_ut));
			return $stmt->fetchAll();
		} catch(PDOException $e) {
			throw new Exception("Impossibile trovare blog dell'utente" . $e->getMessage());
		}
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
									AND commento.id_utente = a.id_utente
									ORDER BY data_ora_comm DESC");
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

	function getLatestPostIndex()
	{
		global $pdo;

		try {
			$stmt = $pdo -> prepare ("
											SELECT titolo_post, testo_post, nome_utente, titolo_blog, nome_cat, nome_tema, id_post, blog.id_blog
											FROM post, blog, categoria, tema, utente_registrato
											WHERE post.id_utente = utente_registrato.id_utente
											AND blog.id_blog = post.id_blog
											AND tema.id_cat = categoria.id_cat
											AND tema.id_tema = blog.id_tema
											ORDER BY post.data_ora_post DESC LIMIT 10");
			$stmt -> execute();
			return $stmt -> fetchAll();
		} catch(PDOException $e) {
			throw new Exception("Impossibile recuperare ultimi post dal Database!");
		}

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

	function getTemiSimili($input, $id_cat)
	{
		global $pdo;

		try {
			$stmt = $pdo->prepare("
											SELECT *
											FROM tema
											WHERE id_cat = :cat
											AND nome_tema LIKE :inp");
			$stmt->execute(array(':cat' => $id_cat, ':inp' => '%' . $input . '%'));
			return $stmt->fetchAll();
		} catch(PDOException $e) {
			throw new Exception("Errore selezione temi");
		}
	}

	function inserisciPost($titolo, $testo, $id_blog, $id_utente)
	{
		global $pdo;

		if($pdo != false) {
			try {
				$stmt = $pdo->prepare("
												INSERT INTO post(titolo_post, testo_post, data_ora_post, id_blog, id_utente, visibile)
												VALUES(:tit, :tes, NOW(), :b_id, :u_id, 1)");
				$stmt->execute(array(':tit' => $titolo, ':tes' => $testo, ':b_id' => $id_blog, ':u_id' => $id_utente));
				return $pdo->lastInsertId();
			} catch(PDOException $e) {
				throw new Exception("Impossibile inserire il Post!" . $e->getMessage());
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
				return $pdo->lastInsertId();
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

	/* TODO: Aggiungere Try Catch
	 * TODO: Rimuovere check pdo == false*/