<?php
	session_start();
	require 'db_handler.php';
	require 'account.php';

	$logged = false;
	$edit = false;
	$canEdit = false;

	if(isset($_GET["edit"])) {
		if($_GET["edit"] == 'true') {
			$edit = true;
		}
	}

	try {
		$pdo = db_connect();
		$account = new Account();
		$logged = $account->loginDaSessione();

		if($edit) {
			if(isset($_GET["blog"])) {
				$blog = getBlog($_GET["blog"]);
				if(!$blog) {
					die("Impossibile trovare il blog richiesto!");
				}
				$coAut = getCoautoriDiBlog($_GET["blog"]);
				if($blog["id_utente"] == $account->getId()) {
					$canEdit = true;
					$_SESSION["edit"] = $_GET["blog"];
				}
				if(is_array($coAut) && count($coAut) > 0) {
					foreach($coAut as $c) {
						if($c["id_utente"] == $account->getId()) {
							$canEdit = true;
							$_SESSION["edit"] = $_GET["blog"];
							break;
						}
					}
				}
			} else {
				$_SESSION["edit"] = -1;
				die("Riferimento al blog da modificare mancante!");
			}
		} else {
		    $_SESSION["edit"] = -1;
        }
	} catch(Exception $e) {
		die($e->getMessage());
	}

	if(!$logged) {
		$pdo = null;
		die("Per creare un blog è necessario autenticarsi!\n<a href = 'login.php'>Login In </a>");
	}
	if($edit && !$canEdit) {
		die("Non hai i permessi di modificare questo blog!");
	}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Creazione blog</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/tema.js"></script>
</head>
<body>
	<?php include 'navbar.php' ?>
    <div class="creazione">
        <form class="form"
              <?php
                  if($canEdit) {
                      echo "action = \"aggiorna_blog.php\"";
                  } else {
                      echo "action = \"insert_blog.php\"";
                  }
                  ?>
              method="post">
            <label for="titolo_blog" class="consegna">Scegli il titolo del tuo blog</label><br/>
            <input type="text" id="titolo_blog" name="titolo_blog" maxlength="100"
				   <?php
					   if($canEdit) {
						   echo "value='" . $blog["titolo_blog"] . "' ";
					   } ?>required><br/>
            <span class="consegna_piccola">Come sfondo del tuo blog, puoi caricare una foto o scegliere un colore di sfondo</span><br/><br/>
            <?php
                $foto = false;
                if($canEdit) {
					if(filter_var($blog["sfondo"], FILTER_VALIDATE_URL)) {
						$foto = true;
					}
					else if($blog["sfondo"]) {
						$foto = false;
					}
                }
            ?>
            <label for="foto_sfondo" class="consegna_piccola">Inserisci l'url della foto</label><br/>
            <input type="url" class="inserimento_url" id="foto_sfondo" name="foto_sfondo"
                <?php
                    if($foto && $canEdit) {
                        echo "value=\"" .  $blog["sfondo"] . "\"";
                    }
                ?>><br/>
            <label for="colore_sfondo" class="consegna_piccola">Scegli il colore di sfondo</label>
            <input type="color" class="bottone_sfondo" id="colore_sfondo" name="colore_sfondo"
                <?php
                    if(!$foto && $canEdit) {
                        echo "value=\"" . $blog["sfondo"] . "\"";
                    }
                ?>><br/>
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
						    if($cat["id_cat"] == $blog["id_cat"] && $canEdit) {
								echo "<option value = '" . $cat["id_cat"] . "' selected>" . $cat["nome_cat"] . "</option>";
                            } else {
								echo "<option value = '" . $cat["id_cat"] . "'>" . $cat["nome_cat"] . "</option>";
                            }
						}
					} catch(Exception $e) {
						echo "<option disabled>Errore! Categorie non trovate. Contattare webmaster</option>";
					}
				?>
            </select><br>
            <label for="tema" class="consegna_piccola">Scegli un tema da dare al tuo blog</label><br/>
            <input type="text" list="temi" class="tema" id="tema" name="tema" maxlength="30"
                   <?php
                       if($canEdit) {
                           echo "value = '" . $blog["nome_tema"] . "'";
                       }
                   ?>required><br/>
            <datalist id="temi"></datalist>
            <input type="submit"
            <?php
                if($canEdit) {
                    echo "value = \"Aggiorna il Blog\"";
                } else {
                    echo "value = \"Crea nuovo Blog\"";
                }
            ?>
            class="bottone">
        </form>
    </div>
</body>
</html>
<?php
	$pdo = null;
?>
