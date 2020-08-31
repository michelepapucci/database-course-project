<?php
require 'db_handler.php';

$data = json_decode($_POST["data"]);
$ret = array();
try {
    $pdo = db_connect();
    if ($data->tipo == "nome") {
        $res = getNomiRicerca($data->input);
        if(is_array($res) && count($res) != 0){
            foreach($res as $r){
                array_push($ret, $r["titolo_blog"]);
            }
        }
        echo json_encode($ret);
    } else if ($data->tipo == "categoria") {
        $res = getCategorieRicerca($data->input);
        if(is_array($res) && count($res) != 0){
            foreach($res as $r){
                array_push($ret, $r["nome_cat"]);
            }
        }
        echo json_encode($ret);
    } else {
        $res = getTemiRicerca($data->input);
        if(is_array($res) && count($res) != 0){
            foreach($res as $r){
                array_push($ret, $r["nome_tema"]);
            }
        }
        echo json_encode($ret);
    }
} catch(Exception $e) {
    die($e->getMessage());
}


