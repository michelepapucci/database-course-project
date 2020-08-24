<?php
	session_start();
	require 'account.php';

	$logged = false;

	$account = new Account();
	$logged = $account->loginDaSessione();

	if(!$logged) {
		die("Impossibile identificare autore post");
	}
	else {
		if(inserisciPost($_POST["titolo_post"], $_POST["testo_post"], $_SESSION["blog_attivo"], $account->getId())){
			echo "Post inserito con successo";
		}
	}

	/*
	 * TODO: Aggiungere immagini al post.
	 * TODO: Controllare che l'utente loggato possa scrivere un post sul blog in questione.
	 */

