<?php
	session_start();
	require 'account.php';
	require 'db_handler.php';
	$logged = false;
	$edit = false;

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

	if(isset($_GET["blog"])) {
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
		if(isset($_GET["edit"])) {
			if($_GET["edit"] == "true" && isset($_GET["id_post"])) {
				$edit = true;
				$_SESSION["edit"] = $_GET["id_post"];
				try {
					$post = getPost($_GET["id_post"]);
				} catch(Exception $e) {
					die($e->getMessage());
				}
			}
		} else {
			$_SESSION["edit"] = -1;
        }
	} else {
		die("Parametri mancanti!");
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
    </head>
    <body>
		<?php include 'navbar.php' ?>
        <div class="creazione">
            <form class="form"
				<?php
					if($edit) {
						echo "action = 'aggiorna_post.php'";
					} else {
						echo "action = 'insert_post.php'";
					}
				?>
                  method="post">
                <label for="titolo_post" class="consegna">Scrivi qui il tuo titolo</label><br/>
                <input type="text" id="titolo_post" name="titolo_post" maxlength="100"
					   <?php
						   if($edit) {
							   echo "value=\"" . $post["titolo_post"] . "\"";
						   }
					   ?>required><br/>
                <div class="appendino">
					<?php
						if(!$edit) {
							?>

                            <input type="button" value="Carica qui le tue foto" class="bottone bottone_foto"
                                   id="bottone_foto"><br/>
							<?php
						} else {
							try {
								$imgs = getImmaginiPost($_GET["id_post"]);
								$counter = 1;
							} catch(Exception $e) {
								die($e->getMessage());
							}
							if($imgs) {
								foreach($imgs as $img) {
									echo "<input type = 'url' class = 'inserimento_url' name = 'immagine" . $counter . "' id = 'immagine" . $counter . "' 
								placeholder='Inserire url della foto che vuoi aggiungere.' value = '" . $img["url"] . "'>";
									$counter++;
								}
							}
							for($counter; $counter < 6; $counter++) {
								echo "<input type = 'url' class = 'inserimento_url' name = 'immagine" . $counter . "' id = 'immagine" . $counter . "' placeholder='Inserire url della foto che vuoi aggiungere.'>";
							}
						}
					?>
                </div>
                <label for="testo_post" class="consegna">Scrivi qui il tuo post</label><br/>
                <div class="post_area">
                    <textarea id="testo_post" name="testo_post" maxlength="10000" rows="20">
                        <?php
							if($edit) {
								echo $post["testo_post"];
							}
						?>
                    </textarea>
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