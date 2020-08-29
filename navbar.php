<?php
    global $logged;
?>
<div class="contenitore_navbar">
    <ul class="navbar_sinistra">
        <li class="navbar_el lista_sinistra"><a class="link_standard" href="index.php">Home</a></li>
        <li class="navbar_el lista_sinistra"><a class="link_standard" href="about.php">About</a></li>
    </ul>
    <div class="navbar_centro">
        <form class="navbar_form">
            <label class="inline" for="ricerca">Cerca un blog per
                <select class="ereditato" name="opzioni" id="opzioni">
                    <option value="nome" id="nome">nome</option>
                    <option value="categoria" id="categoria">categoria</option>
                    <option value="tema" id="tema">tema</option>
                </select> : </label>
            <input type="search" class="navbar_ricerca ereditato" id="ricerca" name="ricerca">
            <input type="submit" class="navbar_bottone ereditato" value="Cerca">
        </form>
    </div>
    <ul class="navbar_destra dropdown">
        <li class="navbar_el lista_destra drop_campo"><a class="link_standard area_utente">Area utente</a>
            <?php
                if($logged){
                    ?>
                    <div class="drop_el">
                        <a href="logout.php">Logout</a>
                        <a href="creazione_blog.php">Crea nuovo Blog</a>
                        <a href="#">Link 3</a>
                    </div>
            <?php
                }
            ?>
        </li>
    </ul>
</div>

