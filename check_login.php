<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';

	$logged = false;

	try {
		$pdo = db_connect();
		$account = new Account();
		$logged = $account->login($_POST["email"], $_POST["password"]);

	} catch(Exception $e) {
		die($e->getMessage());
	}

	if($logged) {
		header("Location: " . $_SESSION["last_page"]);
	} else {
		echo "Email o password errati";
	}
