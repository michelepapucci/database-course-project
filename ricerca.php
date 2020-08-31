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
    <p class = "consegna">Elenco blog in Categoria/Tema</p>
    <p class = "consegna_piccola">Qui puoi trovare il risultato della tua ricerca.<br/>
                                    Nel caso in cui siano presenti più blog, li troverai elencati in ordine alfabetico.<br/>
                                    Per ogni blog potrai vedere l'anteprima dei suoi due/tre post più recenti.</p>
    <div class="contenitore_box contenitore_verticale">
        <div class="box_multipli verticali">
            <a class="link consegna" href="post.php?id_post='">Titolo blog</a><br/><br/>
            <span>Nome autore - </span>
            <span>Tema - </span>
            <span>Categoria</span>
            <div class="contenitore_box">
                <div class="box_multipli">
                    <span class="consegna_media">Nome post</span><br/>
                    <p class="consegna_piccola">Testo post</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>