<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';

	// HTTP_X_REQUESTED_WITH è un valore dell' Header HTTP inviato da Ajax. Se l'utente naviga su questa pagina mediante
	// URL non è settato e non si cancella per errore.
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
		$id = json_decode($_POST["data"]) -> id;
		try {
			$pdo = db_connect();
			$account = new Account();
			$logged = $account->loginDaSessione();
			if($logged) {
				$stmt = $pdo->prepare("DELETE FROM commento WHERE id_comm = :id");
				$stmt->execute(array(':id' => $id));
				echo 'ok';
			}
		} catch(Exception $e) {
			die ($e->getMessage());
		}
	}
