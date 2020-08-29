<?php
	session_start();
	//	ob_start();

	require 'db_handler.php';
	require 'account.php';

	try{
		$pdo = db_connect();
		$account = new Account();
		$id = $account -> nuovoAccount($_POST["nome_utente"], $_POST["password"], $_POST["email"], $_POST["documento"], $_POST["cellulare"]);
		$account -> login($_POST["email"], $_POST["password"]);
		header("Location: " . $_SESSION["last_page"]);
	} catch (Exception $e) {
		echo $e ->getMessage();
	}

	$pdo = null;

