<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';
	$logged = false;
	$propietario = false;
	$coautore = false;
	if(isset($_GET["blog"])) {
		try {
			$pdo = db_connect();
			$blog = getBlog($_GET["blog"]);
			if(!$blog) {
				die("Impossibile trovare il blog richiesto!");
			}
			$coAut = getCoautoriDiBlog($_GET["blog"]);
			$posts = getPostDiBlog($_GET["blog"]);
			$account = new Account();
			$logged = $account->loginDaSessione();
			if($blog["id_utente"] == $account->getId()) {
				$propietario = true;
			}
			if(is_array($coAut) && count($coAut) > 0) {
				foreach($coAut as $c) {
					if($c["id_utente"] == $account->getId()) {
						$coautore = true;
						break;
					}
				}
			}
			if($propietario) {
				$_SESSION["blog_attivo"] = $_GET["blog"];
			} else {
				$_SESSION["blog_attivo"] = '';
			}
		} catch(Exception $e) {
			die($e->getMessage());
		}
	} else {
		die("Parametro Mancante! Impossibile identificare blog richiesto!");
	}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/slideshow.js"></script>
    <script src='js/ricerca.js'></script>
    <?php
        if($propietario) {
            echo '<script src = "js/co-autore.js"></script>';
            echo '<script src = "js/del_blog.js"></script>';
        }
    ?>
    <title><?php echo $blog["titolo_blog"]; ?></title>
</head>
<body class=" <?php echo $blog["font"]; ?>" <?php
	echo "style = '";
	if(filter_var($blog["sfondo"], FILTER_VALIDATE_URL)) {
		echo "background-image: url(\"" . $blog["sfondo"] . "\")'";
	}
	if($blog["sfondo"]) {
		echo "background-color: " . $blog["sfondo"] . "'";
	}
?>>
    <?php include 'navbar.php';?>
    <div class="contenitore">
        <div class="sinistra">
            <h1 class="titolo"><?php echo $blog["titolo_blog"]; ?></h1>
            <span class="autore_post"><?php echo $blog["nome_utente"]; ?> -</span>
            <span class="visualizzazioni"><?php echo $blog["nome_tema"] . " - " . $blog["nome_cat"]; ?> -</span>
            <span class="numero_post">
            <?php
				if(is_array($posts)) {
					echo count($posts);
				}
			?> post</span><br/>
                <?php
                    if(count($coAut) > 0){
                        echo "<span> Co-Autori: ";
                        foreach($coAut as $c) {
                            echo $c["nome_utente"] . " ";
                        }
                        echo "</span>";
                    }
                ?>
            <div class="contenitore_box">
				<?php
					if($propietario || $coautore) {
						echo '<a href="creazione_post.php?blog=' . $_GET["blog"] . '" id="nuovo_post" class="bottone_modifiche link_standard">Scrivi un nuovo post</a>
                              <a href="creazione_blog.php?blog='. $_GET["blog"] .'&edit=true" id="modifica_blog" class="bottone_modifiche link_standard">Modifica Blog</a>';
					}
					if($propietario) {
						echo '<a id = "co-autore-aggiungi" class = "bottone_modifiche">Aggiungi un co-autore</a>';
						echo '<a id = "co-autore-rimuovi" class = "bottone_modifiche">Rimuovi un co-autore</a>';
						echo '<a id="cancella_blog" class="bottone_modifiche link_standard">Cancella blog</a>';
					}
				?>
            </div>
            <div id="co-autore-aggiungi-div" class="nascosto">
                <p>Inserisci l'email della persona che vuoi aggiungere come co-autore e premi "Aggiungi"</p>
                <input type="email" class="campo_piccolo" id="co-autore-aggiungi-email" name="co-autore-aggiungi-email"
                       placeholder="Inserisci l'email">
            </div>
            <div id="co-autore-rimuovi-div" class="nascosto">
                <p>Inserisci l'email della persona che vuoi rimuovere dai co-autori e premi "Rimuovi"</p>
                <input type="email" class="campo_piccolo" id="co-autore-rimuovi-email" name="co-autore-rimuovi-email"
                       placeholder="Inserisci l'email">
            </div>
            <div>
				<?php
					foreach($posts as $post) {
						echo("
                    <a class = 'link_contenitore_post' href = 'post.php?id_post=" . $post["id_post"] . "'>
                        <div class='contenitore_post'>
                            <h3>" . $post["titolo_post"] . "</h3>
                            <p>" . substr($post["testo_post"], 0, 200) . "...</p>
                        </div>
                    </a>");
					}
				?>
            </div>
        </div>
        <div class="destra">
            <div class="div_titoletto">
                <h3 class="titoletto">Altri Blog in <?php echo $blog["nome_cat"] ?></h3>
            </div>
			<?php
				try {
					$cat_blogs = getBlogDiCategoria($blog["id_cat"]);
				} catch(Exception $e) {
					die($e->getMessage());
				}
				if (count($cat_blogs) > 1) {
                    foreach($cat_blogs as $c) {
                        try {
                            if($c["id_blog"] != $_GET["blog"]) {
                                $c_post = getPostDiBlog($c["id_blog"]);
                                if(is_array($c_post) && count($c_post) > 0) {
                                    echo("
                                <div class='contenitore_blog div_titoletto'>
                                    <a class='link titolo_altro_blog'>" . $c["titolo_blog"] . "</a>
                                    <div class='contenitore_post_altro_blog'>
                                        <a class='link titolo_post_altro_blog'>" . $c_post[0]["titolo_post"] . "</a>
                                        <p>" . substr($c_post[0]["testo_post"], 0, 100) . "...</p>
                                    </div>
                                </div>
                            ");
                                }
                            }
                        } catch(Exception $e) {
                            die($e->getMessage());
                        }
                    }
                } else {
				    echo '
                            <div class = "div_titoletto">
                                <p class = "titoletto">Non ci sono altri blog in Biologia.</p>
                            </div>';
                }
			?>
        </div>
    </div>
</body>
</html>

