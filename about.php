<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';

	$logged = false;
	$account = new Account();
	try {
		$pdo = db_connect();
		$logged = $account->loginDaSessione();
	} catch(Exception $e) {
		die($e->getMessage());
	}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>About</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src='js/ricerca.js'></script>
</head>
<body class="home">
    <?php include 'navbar.php';?>
    <p class="consegna_piccola box">Progetto creato da Michele Papucci e Sofia Zuffi per l'esame di Basi di dati
        dell'anno accademico 2019/2020.</p>
</body>
</html>