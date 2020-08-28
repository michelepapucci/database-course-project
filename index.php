<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body class = "home">
    <ul class = "navbar">
        <li class = "navbar_el"><a class = "link_standard" href="index.php">Home</a></li>
        <li class = "navbar_el"><a class = "link_standard" href="news.asp">News</a></li>
        <li class = "navbar_el"><a class = "link_standard" href="contact.asp">Contact</a></li>
        <li class = "navbar_el"><a class = "link_standard" href="about.asp">About</a></li>
        <li class = "navbar_el"><form action="/action_page.php">
            <label for="ricerca">Cerca un blog per <select class = "ereditato" name="opzioni" id="opzioni">
                    <option value="nome" id = "nome">nome</option>
                    <option value="categoria" id = "categoria">categoria</option>
                    <option value="tema" id = "tema">tema</option>
                </select>:</label>
            <input type="search" class = "navbar_ricerca ereditato" id="ricerca" name="ricerca">
            <input type="submit" class = "navbar_bottone ereditato" value = "Cerca">
        </form></li>
        <li class = "navbar_el"><a class = "link_standard" href="index.php">Home</a></li>
    </ul>
    <p class="consegna">Benvenuto su Grindr!</p>
    <p class = "consegna_piccola">Grindr è una piattaforma che ti permette di creare gratuitamente il tuo blog personale, e di condividere
        la tua conoscenza con il mondo! <br/> Il tuo blog verrà inserito in una categoria generale, e per specificare
        meglio l'agomento di cui vorrai trattare, potrai creare da zero una sottocategoria (o tema) specifica (oppure
        potrai sceglierne una già esistente). <br/> Cosa aspetti, registrati e crea subito il tuo blog! </p>
    <div class = "contenitore_box">
        <div class = "box_multipli">
            <p class = "consegna_piccola">Non ti sei ancora registrato?</p><br/>
            <a class = "consegna_media link" href = "registrazione.php">Clicca qui!</a>
        </div>
        <div class = "box_multipli">
            <p class = "consegna_piccola">Hai già un account?</p><br/>
            <a class = "consegna_media link" href = "login.php">Accedi</a>
        </div>
        <div class = "box_multipli">
            <p class = "consegna_piccola">Senti il bisogno di tentare l'ignoto?</p><br/>
            <a class = "consegna_media link" href = "post.php">Visita un blog a caso!</a>
        </div>
    </div>
    <p class = "consegna_media">Sbircia gli ultimi post pubblicati sul sito</p>
    <div class="contenitore_box contenitore_verticale">
        <div class="box_multipli">
            Roba roba roba roba
        </div>
    </div>
</body>
</html>