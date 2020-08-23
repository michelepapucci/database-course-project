<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <?php
    require 'db_handler.php';
    ?>
</head>
<body>
    <h1>Vendi i tuoi dati personali al diavolo</h1>
    <form method = "post" action = "controlla.php" id = "form">
        <label for = "cognome">Cognome:</label>
        <input type = "text" id = "cognome" name = "cognome" maxlength = "40"><br>
        <label for = "nome">Nome:</label>
        <input type = "text" id = "nome" name = "nome" maxlength = "30"><br>
        <label for = "matricola">Matricola:</label>
        <input type = "text" id = "matricola" name = "matricola" maxlength = "12"><br>
        <label for = "email">Email:</label>
        <input type = "text" id = "email" name = "email" maxlength = "30"><br>
        <label for = "telefono">Telefono:</label>
        <input type = "text" id = "telefono" name = "telefono" maxlength = "15"><br>
        <label for = "richieste_particolari">Richieste particolari:</label><br>
        <textarea id = "richieste_particolari" name = "richieste_particolari" rows = "12" cols = "60"></textarea><br>
        <input type = "submit" id = "invio" value = "Invio"><br>
        <input type = "reset"><br>
        <p id = "messaggio"></p>
    </form>
</body>
