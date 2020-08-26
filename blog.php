<!DOCTYPE html>
<html lang="it">
<head>
    <!--
        TODO: Inserimento commenti sotto al post
        TODO: Tirare fuori il font
    -->
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/slideshow.js"></script>
    <?php
    require 'db_handler.php';
    ?>
    <title>Titolo blog</title>
</head>
<body class="contenitore">
    <div class="sinistra">
        <h1 class="titolo">Titolo blog</h1>
        <span class="autore_post"> Zio Pino -</span>
        <span class="visualizzazioni">20 visualizzazioni -</span>
        <span class = "numero_post">102 post</span><br/>
        <div>
            <!-- Quando si clicca sul div del post si va alla pagina di visualizzazione del post -->
            <div class = "contenitore_post">
                <h3>Titolo blog</h3>
                <p>Testo blog</p>
            </div>
        </div>
    </div>
    <div class="destra">
        <div class="div_titoletto">
            <h3 class="titoletto">Blog nella stessa categoria</h3>
        </div>
        <div class = "contenitore_blog div_titoletto">
            <a class = "link titolo_altro_blog">Nome altro blog</a>
            <div class = "contenitore_post_altro_blog">
                <a class = "link titolo_post_altro_blog">Titolo ultimo post altro blog</a>
                <p>Prime due righe dell'ultimo post dell'altro blog della stessa categoria</p>
            </div>
        </div>
    </div>
</body>
</html>

