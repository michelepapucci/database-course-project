<?php
	session_start();
	require 'account.php';
	require 'db_handler.php';

	$logged = false;
	if(isset($_SERVER['HTTP_REFERER'])){
		$_SESSION["last_page"] = $_SERVER['HTTP_REFERER'];
	} else {
		$_SESSION["last_page"] = "index.php";
	}

	$account = new Account();
	try {
		$pdo = db_connect();
		$logged = $account->loginDaSessione();
	} catch(Exception $e) {
		die($e->getMessage());
	}
	if($logged) {
		die("Sei già loggato con un utente. Prima di effettuare nuovamente il log in devi effettuare il <a href = 'logout.php'>logout</a>");
	}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src='js/ricerca.js'></script>
</head>
<body class="autenticazione">
    <?php include 'navbar.php';?>
    <p class="consegna">Registrati</p>
    <div class="box">
        <form id="form" action="insert_nuovo_utente.php" method="post">
            <label for="nome_utente" class="consegna_piccola">Scegli un nome utente<br/>(Questo nome sarà visibile agli
                altri utenti)</label>
            <input type="text" class="campo_piccolo" id="nome_utente" name="nome_utente" maxlength="30" required><br>
            <label for="email" class="consegna_piccola">Inserisci una e-mail</label>
            <input type="email" class="campo_piccolo" id="email" name="email" maxlength="30" required><br>
            <label for="cellulare" class="consegna_piccola">Inserisci un cellulare</label>
            <input type="tel" class="campo_piccolo" id="cellulare" name="cellulare" maxlength="10" required><br>
            <label for="documento" class="consegna_piccola">Inserisci un documento d'identità</label>
            <input type="text" class="campo_piccolo" id="documento" name="documento" maxlength="9" required><br>
            <label for="password" class="consegna_piccola">Inserisci una password<br/>(La password deve contenere almeno: <br/>
                - una lettera minuscola<br/>- una lettera maiuscola<br/>- un numero)</label><br>
            <input type="password" class="campo_piccolo" id="password" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" maxlength="16" required</input><br>
            <input type="submit" class="bottone bottone_piccolo" id="invio" value="Registrati"><br>
        </form>
    </div>
</body>
