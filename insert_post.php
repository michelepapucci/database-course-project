<?php
	session_start();
	require 'account.php';
	require 'db_handler.php';
	$logged = false;

	try {
		$pdo = db_connect();
		$account = new Account();
		$logged = $account->loginDaSessione();
	} catch(Exception $e){
		die($e -> getMessage());
	}

	if(!$logged) {
		$pdo = null;
		die("Immpossibile identificare autore del post.<br/><a href = 'login.php'>Login In </a>");
	} else {
		$immagini = array();
		for($i = 1; $i < 6; $i++) {
			if(isset($_POST["immagine" . $i])) {
				if(is_array(@getimagesize($_POST["immagine" . $i]))){
					array_push($immagini, $_POST["immagine" . $i]);
				} else {
					echo "Non è stato possibile inserire l'immagine " . $i . ". Controllare che il link all'immagine sia corretto.<br/>";
				}
			}
		}
		try {
			 $id = inserisciPost($_POST["titolo_post"], $_POST["testo_post"], $_SESSION["blog_attivo"], $account->getId());
			if($id && count($immagini) != 0){
				inserisciImmaginiPost($id, $immagini);
			}

			header("location: post.php?id_post=".$id);

		} catch(Exception $e) {
			die($e->getMessage());
		}
	}


