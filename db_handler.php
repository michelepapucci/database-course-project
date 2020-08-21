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
		} catch (Exception $e) {
			error_log($e->getMessage());
			echo("Errore 500: Impossibile connettersi al Database!");
			return false;
		}
	}

	//Cerco e restituisco un post con un certo id
	function getPost($post_id)
	{
		$conn = db_connect();
		if($conn != false) {
			$stmt = $conn->prepare("SELECT * FROM post WHERE id_post = :id");
			$stmt -> bindParam(':id', $post_id);
			$stmt -> execute();
			if($post = $stmt -> fetch()) {
				$conn = null;
				return $post;
			}
		}
		$conn = null;
		return false;
	}

	//Cerco e restituisco tutti i commenti ad un certo post
	function getCommenti($post_id)
	{
		$conn = db_connect();
		if($conn != false) {
			$stmt = $conn->prepare("SELECT * FROM commento WHERE id_post = :id");
			$stmt -> bindParam(':id', $post_id);
			$stmt -> execute();
			if($commenti = $stmt -> fetchAll()) {
				$conn = null;
				return $commenti;
			}
		}
		$conn = null;
		return false; 
	}

	function getBlogLatestPost($post_id)
	{
		$conn = db_connect();
		if($conn != false) {
			$stmt = $conn -> prepare("SELECT id_blog FROM post WHERE id_post = :id");
			$stmt -> bindParam(':id', $post_id);
			$stmt -> execute();
			$blog_id = $stmt -> fetchColumn(0);
			echo $blog_id;
		}
	}
