<!DOCTYPE html>
<html lang="it">
<head>
    <!--
        TODO: Inserimento commenti sotto al post
    -->
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/slideshow.js"></script>
	<?php
		require 'db_handler.php';
		if(isset($_GET["id_post"])){
			$post = getPost($_GET["id_post"]);
			if ($post == false) {
				exit("ERRORE 404 - Pagina non trovata!");
			}
        }
		else {
		    exit("ERRORE 400 - Nessun post specificato!");
        }

	?>
    <title><?php echo $post["titolo_post"] ?></title>
</head>
<body>
    <div class="contenitore">
        <div class="sinistra">
            <h1 class="titolo"><?php echo $post["titolo_post"] ?></h1>
            <div>
                <span class="autore_post"><?php echo $post["nome_utente"] ?> -</span>
                <span class="data_post"><?php echo $post["data_ora_post"] ?> -</span>
                <span class="visualizzazioni">20 visualizzazioni -</span>
                <a class="link" href="#commenti">Commenti (<?php echo(getNumeroCommenti($post["id_post"])); ?>)</a> <br/>
					<?php
						$immagini = getImmaginiPost($post["id_post"]);
						if($immagini != false) {
						    echo("<div class = \"slideshow\">");
							foreach($immagini as $immagine) {
								echo("<img class='immagine' style = 'display:none' src='" . $immagine["url"] . "'/>");
							}
                            echo("<a class=\"prev\">&#10094;</a>
                                    <a class=\"next\">&#10095;</a>
                                    <div style=\"text-align:center\">");
                            for($i = 0; $i < count($immagini); $i++){
                                echo("<span class='dot' id='$i'></span>");
                            }
                            echo("</div></div>");
						}
                        ?>
                <p class="testo"><?php echo $post["testo_post"] ?></p>
            </div>
            <!-- Id ancora per link ai commenti -->
            <div id="commenti">
                <div class="div_titoletto">
                    <h3 class="titoletto">Commenti</h3>
                </div>
				<?php
					$commenti = getCommenti($post["id_post"]);
					if ($commenti == false) {
						echo "<div><p>Nessun Commento sotto a questo post</p></div>";
					} else {
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
					}
				?>
            </div>
        </div>
        <div class="destra">
            <div class="div_titoletto">
                <h3 class="titoletto">Post recenti</h3>
            </div>
			<?php
				$posts = getLatestPostSidebar($post["id_post"]);
				foreach ($posts as $l_post) {
					if ($post["id_post"] != $l_post["id_post"]) {
						echo("
                        <div class = 'post_recenti'>
                            <a class = 'link' href = 'http://localhost/progettoBDD/post.php?id_post=" . $l_post["id_post"] . "'>" . $l_post["titolo_post"] . "</a>
                            <p>" . substr($l_post["testo_post"], 0, 100) . "...</p>
                        </div>
                        ");
					}
				}
			?>
        </div>
    </div>
</body>
</html>
