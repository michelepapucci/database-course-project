<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Creazione del post</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <?php
    require 'db_handler.php';
    ?>
</head>
<body class = "creazione">
    <form action = "" method = "get">
        <label for="titolo_post" class = "consegna">Scrivi qui il tuo titolo</label><br/>
        <input type = "text" id="titolo_post" name="titolo_post" maxlength="100" ><br/>
        <input type = "button" value = "Carica qui le tue foto" class = "bottone" id = "bottone_foto"><br/>
        <label for = "testo_post" class = "consegna">Scrivi qui il tuo post</label><br/>
        <textarea id = "testo_post" name = "testo_post" maxlength = "10000" rows = "20"></textarea><br/>
        <input type = "submit" value = "Pubblica" class = "bottone">
    </form>
</body><?php
