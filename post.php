<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Post</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<?php
		require 'db_handler.php';
		$post = getPost($_GET["post_id"]);
		if($post == false) {
		    exit("ERRORE 404 - Pagina non trovata!");
        }
	?>
</head>
<body class = "body">
    <div class="contenitore">
        <div class="sinistra">
            <h1 class="titolo"><?php echo $post["titolo_post"]?></h1>
            <div>
                <span class="autore_post"><?php echo $post["nome_utente"] ?> -</span>
                <span class="data_post"><?php echo $post["data_ora_post"] ?> -</span>
                <span class="visualizzazioni">20 visualizzazioni -</span>
                <a class = "link" href="#commenti">Commenti</a> <br/>
                <img class="immagine" src="img/1.jpg" alt="gattino">
                <p class="testo"><?php echo $post["testo_post"] ?></p>
            </div>
            <div>
                <h3 id="commenti">Commenti</h3>
				<?php
					$commenti = getCommenti($_GET["post_id"]);
					foreach ($commenti as $commento) {
						echo("
                            <div>
                                <p class = \"commento\">
                                    <span class = \"autore_commento\">" . $commento["nome_utente"] . ":</span><br/>"
							. $commento["testo_comm"] . "<br/>
                                    <span class = \"data_commento\">(" . $commento["data_ora_comm"] . ")</span>
                                </p>
                            </div>         
                        ");
					}
				?>
            </div>
        </div>
        <div class="destra">
            <div class="post_recenti">
                <h3>Titolo</h3>
                <p class="testo">Testo post</p>
            </div>
        </div>
    </div>
</body><?php
