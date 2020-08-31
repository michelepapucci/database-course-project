<?php
	session_start();
	require 'account.php';
	require 'db_handler.php';
	$logged = false;
	try {
		$pdo = db_connect();
		$account = new Account();
		$logged = $account->loginDaSessione();
		$ut_blogs = getBlogUtente($account->getId());
	} catch(Exception $e) {
		echo $e->getMessage();
	}

	if(!$logged) {
		$pdo = null;
		echo("Per creare un post è necessario autenticarsi!\n<a href = 'login.php'>Login In </a>");
		exit();
	}

	foreach($ut_blogs as $b) {
		if($b["id_blog"] == $_GET["blog"]) {
			$_SESSION["blog_attivo"] = $_GET["blog"];
			break;
		}
		$_SESSION["blog_attivo"] = NULL;
	}
	if($_SESSION["blog_attivo"] == NULL) {
		die("Non puoi pubblicare un post su questo blog!");
	}
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Creazione del post</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="js/img.js"></script>
        <script src="js/creazione_post.js"></script>
        <script src='js/ricerca.js'></script>
    </head>
    <body>
		<?php include 'navbar.php' ?>
        <div class="creazione">
            <form class="form" action="insert_post.php" method="post">
                <label for="titolo_post" class="consegna">Scrivi qui il tuo titolo</label><br/>
                <input type="text" id="titolo_post" name="titolo_post" maxlength="100" required><br/>
                <div class="appendino">
                    <input type="button" value="Carica qui le tue foto" class="bottone bottone_foto"
                           id="bottone_foto"><br/>
                </div>
                <label for="testo_post" class="consegna">Scrivi qui il tuo post</label><br/>
                <div class="post_area">
                    <textarea id="testo_post" name="testo_post" maxlength="10000" rows="20"></textarea>
                    <a id="caratteri_rim">0</a><br/>
                </div>
                <input type="submit" value="Pubblica" class="bottone">
            </form>
        </div>
    </body>
    </html>
<?php
	$pdo = null;
?>