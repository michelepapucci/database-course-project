<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';

	$logged = false;

	try {
		$pdo = db_connect();
		$account = new Account();
		$logged = $account->loginDaSessione();
	} catch(Exception $e) {
		die($e->getMessage());
	}

	if(!$logged) {
		$pdo = null;
		echo("Per creare un blog è necessario autenticarsi!\n<a href = 'login.php'>Login In </a>");
		exit();
	} else { ?>
        <!DOCTYPE html>
        <html lang="it">
        <head>
            <meta charset="UTF-8">
            <title><C></C>reazione blog</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="js/tema.js"></script>
        </head>
        <body class="creazione">
            <form action="insert_blog.php" method="post">
                <label for="titolo_blog" class="consegna">Scegli il titolo del tuo blog</label><br/>
                <input type="text" id="titolo_blog" name="titolo_blog" maxlength="100" required><br/>
                <span class="consegna_piccola">Come sfondo del tuo blog, puoi caricare una foto o scegliere un colore di sfondo</span><br/><br/>
                <label for="foto_sfondo" class="consegna_piccola">Inserisci l'url della foto</label><br/>
                <input type="url" class="inserimento_url" id="foto_sfondo" name="foto_sfondo"><br/>
                <label for="colore_sfondo" class="consegna_piccola">Scegli il colore di sfondo</label>
                <input type="color" class="bottone_sfondo" id="colore_sfondo" name="colore_sfondo"><br/>
                <label for="font" class="consegna_piccola">Scegli un font per il tuo blog</label>
                <select class="selezione" id="font" name="font" required>
                    <option value="roboto" class="roboto">Roboto</option>
                    <option value="open_sans" class="open_sans">Open Sans</option>
                    <option value="lato" class="lato">Lato</option>
                    <option value="slabo" class="slabo">Slabo</option>
                    <option value="oswald" class="oswald">Oswald</option>
                    <option value="source_sans_pro" class="source_sans_pro">Source Sans Pro</option>
                    <option value="montserrat" class="montserrat">Montserrat</option>
                    <option value="raleway" class="raleway">Raleway</option>
                    <option value="pt_sans" class="pt_sans">PT Sans</option>
                    <option value="lora" class="lora">Lora</option>
                </select><br/>
                <label for="categoria" class="consegna_piccola">Scegli una categoria in cui inserire il tuo blog</label>
                <select class="selezione" id="categoria" name="categoria" required>
					<?php
						try {
							$categorie = getCategorie();
							foreach($categorie as $cat) {
								echo "<option value = '" . $cat["id_cat"] . "'>" . $cat["nome_cat"] . "</option>";
							}
						} catch(Exception $e) {
							echo "<option disabled>Errore! Categorie non trovate. Contattare webmaster</option>";
						}
					?>
                </select><br>
                <label for="tema" class="consegna_piccola">Scegli un tema da dare al tuo blog</label><br/>
                <!-- TODO: guardare se stilabile -->
                <input type="text" list = "temi" class="tema" id="tema" name="tema" maxlength="30" required><br/>
                <datalist id="temi"></datalist>
                <input type="submit" value="Crea blog" class="bottone">
            </form>
        </body>
        </html>
		<?php
	}
	$pdo = null;
?>
