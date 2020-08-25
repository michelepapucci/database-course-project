<?php
	session_start();

	require 'account.php';
	require 'db_handler.php';

	try {
		$pdo = db_connect();
		$account = new Account();
		if($account -> loginDaSessione()) {
			$account->logout();
			header("Location: index.php");
		}
	} catch(Exception $e) {
		echo $e ->getMessage();
	}