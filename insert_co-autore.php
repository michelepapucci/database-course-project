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

if($logged) {
    echo "kek";
}
