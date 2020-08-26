<?php
	require 'db_handler.php';

	$data = json_decode($_POST["data"]);
	$ret = array();
	try {
		$pdo = db_connect();
		$res = getTemiSimili($data->input, $data->categoria);;
		if(is_array($res) && count($res) != 0){
			foreach($res as $r){
				array_push($ret, $r["nome_tema"]);
			}
		}
		echo json_encode($ret);
	} catch(Exception $e) {
		die($e->getMessage());
	}


