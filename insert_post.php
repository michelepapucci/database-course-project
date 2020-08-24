<?php
	session_start();
	require 'account.php';
	require 'db_handler.php';

	$pdo = db_connect();

	$logged = false;
	$account = new Account();
	$logged = $account->loginDaSessione();

	if(!$logged) {
		$pdo = null;
		echo("Immpossibile identificare autore del post.\n<a href = 'login.php'>Login In </a>");
		exit();
	} else {
		$immagini = array();
		for($i = 1; $i < 6; $i++) {
			if(isset($_POST["immagine" . $i])) {
				array_push($immagini, $_POST["immagine" . $i]);
			}
		}
		try {
			 $id = inserisciPost($_POST["titolo_post"], $_POST["testo_post"], $_SESSION["blog_attivo"], $account->getId());
			if($id != false && count($immagini) != 0){
				inserisciImmaginiPost($id, $immagini);
			}
			/*
			 * TODO: Pagina decente di conferma inserimento post.
			 */
			echo "Inserimento avvenuto con successo.\nPost visibile <a href = 'post.php?id_post=". $id."'>qui</a>";

		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	$pdo = null;
	/*
	 * TODO: Controllare che l'utente loggato possa scrivere un post sul blog in questione.
	 */

