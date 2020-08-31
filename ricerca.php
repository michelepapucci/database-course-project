<?php
    session_start();
    require 'db_handler.php';
    require 'account.php';

    $logged = false;
    $account = new Account();
    try {
        $pdo = db_connect();
        $logged = $account->loginDaSessione();
        if (isset($_GET["opzioni"]) && isset($_GET["ricerca"])) {
            $res = null;
            if($_GET["opzioni"] == "nome") {
                $res = getBlogPerNome($_GET["ricerca"]);
            } else if ($_GET["opzioni"] == "categoria") {
                $res = getBlogPerCategoria($_GET["ricerca"]);
            } else if ($_GET["opzioni"] == "tema") {
                $res = getBlogPerTema($_GET["ricerca"]);
            } else {
                die("Parametro opzioni errato");
            }
        } else {
            die("Parametri mancanti nella ricerca");
        }
    } catch(Exception $e) {
        die($e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src='js/ricerca.js'></script>
</head>
<body class = "home">
    <?php include 'navbar.php';?>
    <p class = "consegna">Elenco blog in Categoria/Tema</p>
    <p class = "consegna_piccola">Qui puoi trovare il risultato della tua ricerca.<br/>
                                    Nel caso in cui siano presenti più blog, li troverai elencati in ordine alfabetico.<br/>
                                    Per ogni blog potrai vedere l'anteprima dei suoi due/tre post più recenti.</p>
    <?php
    if(is_array($res) && count($res) > 0) {
    ?>
    <div class="contenitore_box contenitore_verticale">
        <?php
            foreach ($res as $r) {
                echo '
                    <div class="box_multipli verticali">
                        <a class="link consegna" href="blog.php?blog=' . $r["id_blog"] . '">' . $r["titolo_blog"] . '</a><br/><br/>
                        <span>' . $r["nome_utente"] . ' - </span>
                        <span>' . $r["nome_tema"] . ' - </span>
                        <span>' . $r["nome_cat"] . '</span>';
                        try {
                            $posts = array();
                            $posts = getPostDiBlog($r["id_blog"]);
                            if (count($posts) > 0) {
                                echo '<div class="contenitore_box">';
                                foreach ($posts as $i => $p) {
                                    if($i > 2) {
                                        break;
                                    }
                                    echo ' 
                                            <div class="box_multipli box_multipli_ricerca">
                                                <a class="link consegna_media" href="post.php?id_post=' . $p["id_post"] . '">' . $p["titolo_post"] . '</a><br/>
                                                <p class="consegna_piccola">' . substr($p["testo_post"], 0, 200) . '...</p>
                                            </div>';
                                }
                                echo '</div>';
                            } else {
                                echo '<br/><p class="consegna_piccola">-<br/>Sembra che questo blog non contenga ancora post. <br/>-</p>';
                            }
                        } catch(Exception $e) {
                            die($e->getMessage());
                        }
                        ?>
                    </div>
        <?php
            }
        ?>
    </div>
    <?php
    } else {
        echo '<p class="consegna_piccola">-<br/>Oh no! Qualcosa è andato storto! <br/>';
        if ($_GET["opzioni"] == "categoria") {
            echo 'Ricordati, al contrario della ricerca per nome o per tema, 
                    il nome della categoria va inserito per intero nella barra di ricerca.';
        }
        echo '<br/>-</p>';
    }
    ?>
</body>
</html>