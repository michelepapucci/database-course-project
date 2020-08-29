<?php
    session_start();

    $_SESSION["last_page"] = $_SERVER['HTTP_REFERER'];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body class="autenticazione">
    <?php include 'navbar.php' ?>
    <p class="consegna">Accedi</p>
    <div class="box">
        <form action="check_login.php" method="post">
            <label for="email" class="consegna_piccola">E-mail</label><br/>
            <input type="email" class="campo_piccolo" id="email" name="email" maxlength="50"><br/>
            <label for="password" class="consegna_piccola">Password</label><br/>
            <input type="password" class="campo_piccolo" id="password" name="password" maxlength="16"><br/>
            <input type="submit" class="bottone bottone_piccolo" id="invio" value="Accedi"><br>
        </form>
    </div>
    <br/>
    <span class="consegna_piccola">Non hai ancora un account? <br/></span><a class="link consegna_piccola"
                                                                             href="registrazione.php">Registrati qui</a>
</body>
</html>
