<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';

	$logged = false;

	try {
		$pdo = db_connect();
		$account = new Account();
		$logged = $account->loginDaSessione();
	} catch(Exception $e) {
		die($e->getMessage());
	}

	if(!$logged) {
		$pdo = null;
		die("Impossibile identificare autore del blog!<br/><a href = 'login.php'>Login In </a>");
	} else {
		try {
			$id = checkPresenzaTema($_POST["tema"], $_POST["categoria"]);
			if(!$id) {
				$id = inserisciNuovoTema($_POST["tema"], $_POST["categoria"]);
			}
			if($_POST["foto_sfondo"] != "") {
				$sfondo = $_POST["foto_sfondo"];
			} else {
				$sfondo = $_POST["colore_sfondo"];
			}
			$id_blog = inserisciNuovoBlog($_POST["titolo_blog"], $id, $account->getId(), $sfondo, $_POST["font"]);
			header("location: blog.php?blog=".$id_blog);
			echo("Nuovo blog creato con successo, puoi vederlo <a href='blog.php?blog=$id_blog'>qui</a>");
		} catch(Exception $e) {
			echo $e -> getMessage();
		}
	}

