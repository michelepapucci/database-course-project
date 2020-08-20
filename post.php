<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Post</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <?php
      require 'db_handler.php';
    ?>
</head>
<body>
    <h1 class = "titolo">Tua mamma</h1>
    <div class = "contenitore">
        <div class = "sinistra">
            <div>
                <?php
                    $post = getPost()
                ?>
                <span class = "autore_post">Mario Rossi -</span> <span class = "data_post">10 agosto 2020 -</span>
                <span class = "visualizzazioni">20 visualizzazioni -</span>
                <a href="#commenti">Commenti</a> <br/>
                <img class = "immagine" src="img/1.jpg" alt="gattino">
                <p class = "testo">Tua mamma è una grandissima donna. "Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
            </div>
            <div>
                <h3 id="commenti">Commenti</h3>
                <div>
                    <p class = "commento">
                        <span class = "autore_commento">Guido Bianchi:</span><br/>
                        Hai ragione, mia mamma è una grandissima donna.<br/>
                        <span class = "data_commento">(12 agosto 2020)</span>
                    </p>
                </div>
                <div>
                    <p class = "commento">
                        <span class = "autore_commento">Mr.Simpatia:</span><br/>
                    Io non sono d'accordo. Mia mamma è alta solo un metro e 50. <br/>
                        <span class = "data_commento">(13 agosto 2020)</span>
                    </p>
                </div>
            </div>
        </div>
        <div class = "destra">
            <div class = "post_recenti">
                <h3>Titolo</h3>
                <p class = "testo">Testo post</p>
            </div>
        </div>
    </div>
</body><?php
