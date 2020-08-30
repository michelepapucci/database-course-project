<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';

	// HTTP_X_REQUESTED_WITH è un valore dell' Header HTTP inviato da Ajax. Se l'utente naviga su questa pagina mediante
	// URL non è settato e non si cancella per errore.
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
		try {
			$pdo = db_connect();
			$account = new Account();
			$logged = $account->loginDaSessione();
			if($logged && $_SESSION["post_attivo"] != '' && isset($_SESSION["post_attivo"])) {
				$stmt = $pdo->prepare("DELETE FROM post WHERE id_post = :id");
				$stmt->execute(array(':id' => $_SESSION["post_attivo"]));
				echo 'ok';
			}
		} catch(Exception $e) {
			die ($e->getMessage());
		}
	}
