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
		echo $e->getMessage();
	}

	$msg = json_decode($_POST["data"]);

	if($logged) {
		try {
			$stmt = $pdo->prepare("INSERT INTO commento(data_ora_comm, testo_comm, id_utente, id_post)
											VALUES(NOW(),:test, :u_id, :p_id)");
			$stmt->execute(array(':test' => $msg->testo_commento, ':u_id' => $account->getId(), ':p_id' => $_SESSION["post_attivo"]));
			echo "ok";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}