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

	if($logged && isset($_SESSION["blog_attivo"]) && $_SESSION["blog_attivo"] != "") {
		try {
			$stmt = $pdo->prepare(
				"DELETE FROM co_autore
                                        WHERE id_blog = :b_id
                                        AND id_utente = (SELECT id_utente
                                                            FROM utente_registrato
                                                            WHERE email = :email  
                                                            )");
			$stmt->execute(array(':b_id' => $_SESSION["blog_attivo"], ':email' => $msg->email));
			echo "ok";
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}

