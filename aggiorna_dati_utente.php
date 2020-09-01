<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';

	try{
		$pdo = db_connect();
		$account = new Account();
		$account -> loginDaSessione();
		$account -> modificaAccount($_POST["nome_utente"], $_POST["password"], $_POST["email"], $_POST["documento"], $_POST["cellulare"]);
		header("Location: index.php");
	} catch (Exception $e) {
		echo $e ->getMessage();
	}