<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';
	$logged = false;
	if(isset($_GET["blog"])) {
		try {
			$pdo = db_connect();
			$blog = getBlog($_GET["blog"]);
			if(!$blog) {
				die("Impossibile trovare il blog richiesto!");
			}
			$posts = getPostDiBlog($_GET["blog"]);
			$account = new Account();
			$logged = $account -> loginDaSessione();
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
    <?php include 'navbar.php' ?>
    <div class = "contenitore">
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
            <div>
                <?php
                foreach($posts as $post) {
                    echo("
                    <a class = 'link_contenitore_post' href = 'post.php?id_post=" . $post["id_post"] . "'>
                        <div class='contenitore_post'>
                            <h3>" . $post["titolo_post"] . "</h3>
                            <p>" . substr($post["testo_post"], 0, 100) . "...</p>
                        </div>
                    </a>");
                }
                ?>
                <!-- Quando si clicca sul div del post si va alla pagina di visualizzazione del post -->
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
            ?>
        </div>
    </div>
</body>
</html>

