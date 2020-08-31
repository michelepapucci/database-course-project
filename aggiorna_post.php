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
	if($logged && isset($_SESSION["edit"])) {
		if($_SESSION["edit"] != -1) {
			try {
				$stmt = $pdo->prepare("DELETE FROM immagine WHERE id_post = :id");
				$stmt->execute(array(':id' => $_SESSION["edit"]));

				$stmt = $pdo->prepare("
												UPDATE post 
												SET titolo_post = :tit,
												testo_post = :testo
												WHERE id_post = :id");
				$stmt->execute(array(':tit' => $_POST["titolo_post"], ':testo' => $_POST["testo_post"], ':id' => $_SESSION["edit"]));

				$immagini = array();
				for($i = 1; $i < 6; $i++) {
					if(isset($_POST["immagine" . $i])) {
						if($_POST["immagine" . $i] != ""){
							if(is_array(@getimagesize($_POST["immagine" . $i]))) {
								array_push($immagini, $_POST["immagine" . $i]);
							} else {
								echo "Non è stato possibile inserire l'immagine " . $i . ". Controllare che il link all'immagine sia corretto.<br/>";
							}
						}
					}
				}

				if(count($immagini) > 0) {
					inserisciImmaginiPost($_SESSION["edit"], $immagini);
				}
				header("location: post.php?id_post=" . $_SESSION["edit"]);
			} catch(Exception | PDOException $e) {
				die($e->getMessage());
			}
		}
	} //TODO: controllare se va.