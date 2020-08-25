<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Creazione blog</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <?php
    require 'db_handler.php';
    ?>
</head>
<body class="creazione">
    <form action="" method="post">
        <label for="titolo_blog" class="consegna">Scegli il titolo del tuo blog</label><br/>
        <input type="text" id="titolo_blog" name="titolo_blog" maxlength="100" required><br/>
        <span class = "consegna_piccola">Come sfondo del tuo blog, puoi caricare una foto o scegliere un colore di sfondo</span><br/><br/>
        <label for = "foto_sfondo" class = "consegna_piccola">Inserisci l'url della foto</label><br/>
        <input type="url" class = "inserimento_url" id = "foto_sfondo" name = "foto_sfondo"><br/>
        <label for="colore_sfondo" class="consegna_piccola">Scegli il colore di sfondo</label>
        <input type="color" class="bottone_sfondo" id = "colore_sfondo" name = "colore_sfondo"><br/>
        <label for = "font" class = "consegna_piccola">Scegli un font per il tuo blog</label>
        <select class = "selezione" id = "font" name = "font" required>
            <option value = "roboto" class = "roboto">Roboto</option>
            <option value = "open_sans" class = "open_sans">Open Sans</option>
            <option value = "lato" class = "lato">Lato</option>
            <option value = "slabo" class = "slabo">Slabo</option>
            <option value = "oswald" class = "oswald">Oswald</option>
            <option value = "source_sans_pro" class = "source_sans_pro">Source Sans Pro</option>
            <option value = "montserrat" class = "montserrat">Montserrat</option>
            <option value = "raleway" class = "railway">Raleway</option>
            <option value = "pt_sans" class = "pt_sans">PT Sans</option>
            <option value = "lora" class = "lora">Lora</option>
        </select><br/>
        <label for = "categoria" class = "consegna_piccola">Scegli una categoria in cui inserire il tuo blog</label>
        <select class = "selezione" id = "categoria" name = "categoria" required>
            <!-- scienze matematiche, fisiche e naturali -->
            <option value = "anatomia">Anatomia</option>
            <option value = "astronomia">Astronomia</option>
            <option value = "biologia">Biologia</option>
            <option value = "botanica">Botanica</option>
            <option value = "chimica">Chimica</option>
            <option value = "climatologia">Climatologia</option>
            <option value = "ecologia">Ecologia</option>
            <option value = "fisica">Fisica</option>
            <option value = "fisiologia">Fisiologia</option>
            <option value = "geologia">Geologia</option>
            <option value = "geometria">Geometria</option>
            <option value = "logica">Logica</option>
            <option value = "matematica">Matematica</option>
            <option value = "meteorologia">Meteorologia</option>
            <option value = "metrologia">Metrologia</option>
            <option value = "paleontologia">Paleontologia</option>
            <option value = "statistica">Statistica</option>
            <option value = "zoologia">Zoologia</option>
            <!-- arte -->
            <option value = "animazione">Animazione</option>
            <option value = "arte_digitale">Arte digitale</option>
            <option value = "arti_visive">Arti visive</option>
            <option value = "arti_performative">Arti performative</option>
            <option value = "canto">Canto</option>
            <option value = "cinema">Cinema</option>
            <option value = "danza">Danza</option>
            <option value = "fotografia">Fotografia</option>
            <option value = "fumetto">Fumetto</option>
            <option value = "grafica">Grafica</option>
            <option value = "letteratura">Letteratura</option>
            <option value = "musica">Musica</option>
            <option value = "pittura">Pittura</option>
            <option value = "scultura">Scultura</option>
            <option value = "teatro">Teatro</option>
            <option value = "televisione">Televisione</option>
            <!-- scienze umane e sociali -->
            <option value = "antropologia">Antropologia</option>
            <option value = "archeologia">Archeologia</option>
            <option value = "criminologia">Criminologia</option>
            <option value = "diritto">Diritto</option>
            <option value = "economia">Economia</option>
            <option value = "educazione">Educazione</option>
            <option value = "etnologia">Etnologia</option>
            <option value = "finanza">Finanza</option>
            <option value = "filosofia">Filosofia</option>
            <option value = "geografia">Geografia</option>
            <option value = "linguistica">Linguistica</option>
            <option value = "mitologia">Mitologia</option>
            <option value = "psicologia">Psicologia</option>
            <option value = "sociologia">Sociologia</option>
            <option value = "storia">Storia</option>
            <!-- costume e società -->
            <option value = "ambiente">Ambiente</option>
            <option value = "attività">Attività</option>
            <option value = "comunicazione">Comunicazione</option>
            <option value = "eventi">Eventi</option>
            <option value = "hobby">Hobby</option>
            <option value = "mass_media">Mass media</option>
            <option value = "moda">Moda</option>
            <option value = "persone">Persone</option>
            <option value = "politica">Politica</option>
            <option value = "religione">Religione</option>
            <option value = "salute">Salute</option>
            <option value = "sport">Sport</option>
            <option value = "turismo">Turismo</option>
            <!-- tecnologia e scienze applicate -->
            <option value = "aviazione">Aviazione</option>
            <option value = "agricoltura">Agricoltura</option>
            <option value = "alimentazione">Alimentazione</option>
            <option value = "architettura">Architettura</option>
            <option value = "astronautica">Astronautica</option>
            <option value = "costruzioni">Costruzioni</option>
            <option value = "design">Design</option>
            <option value = "edilizia">Edilizia</option>
            <option value = "elettronica">Elettronica</option>
            <option value = "elettrotecnica">Elettrotecnica</option>
            <option value = "geotecnica">Geotecnica</option>
            <option value = "idraulica">Idraulica</option>
            <option value = "informatica">Informatica</option>
            <option value = "infrastrutture">Infrastrutture</option>
            <option value = "ingegneria">Ingegneria</option>
            <option value = "materiali">Materiali</option>
            <option value = "medicina">Medicina</option>
            <option value = "medicina_veterinaria">Medicina veterinaria</option>
            <option value = "robotica">Robotica</option>
            <option value = "sistemi">Sistemi</option>
            <option value = "standard">Standard</option>
            <option value = "tecnologia">Tecnologia</option>
            <option value = "telecomunicazioni">Telecomunicazioni</option>
            <option value = "trasporti">Trasporti</option>
            <option value = "Urbanistica">Urbanistica</option>
        </select><br>
        <label for="tema" class="consegna_piccola">Scegli un tema da dare al tuo blog</label><br/>
        <input type="text" class = "tema" id="tema" name="tema" maxlength="30" required><br/>
        <input type="submit" value="Crea blog" class="bottone">
    </form>
</body>
<!-- TODO: Visualizzare numero di caratteri rimanenti durante scrittura post -->
<!-- TODO: Gestire l'inserimento del font -->
<!-- TODO: Fare la pagina javascript che gestisce l'inserimento del tema -->
</html>
</body>
