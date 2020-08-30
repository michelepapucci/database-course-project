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
    echo $e->getMessage();
}

$msg = json_decode($_POST["data"]);

if($logged && isset($_SESSION["blog_attivo"]) && $_SESSION["blog_attivo"] != "") {
    try {
        $stmt = $pdo -> prepare(
                                "INSERT INTO co_autore(id_blog, id_utente)
                                            VALUES (:b_id, (SELECT id_utente
                                                            FROM utente_registrato
                                                            WHERE email = :email  
                                                            ))");
        $stmt -> execute(array(':b_id' => $_SESSION["blog_attivo"], ':email' => $msg -> email));
        echo "ok";
    } catch (PDOException $e) {
        die($e -> getMessage());
    }
}
