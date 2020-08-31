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
		die($e->getMessage());
	}
	if($logged && isset($_SESSION["edit"])){
		if($_SESSION["edit"] != -1) {
			try{
				$id = checkPresenzaTema($_POST["tema"], $_POST["categoria"]);
				if(!$id) {
					$id = inserisciNuovoTema($_POST["tema"], $_POST["categoria"]);
				}
				if($_POST["foto_sfondo"] != "") {
					$sfondo = $_POST["foto_sfondo"];
				} else {
					$sfondo = $_POST["colore_sfondo"];
				}
				$stmt = $pdo->prepare("
				UPDATE blog
				SET titolo_blog = :tit,
				    id_tema = :t_id,
				    sfondo = :sfondo,
				    font = :font
				WHERE id_blog = :b_id");
				$stmt->execute(array(':tit'=>$_POST["titolo_blog"], ':t_id'=>$id, ':sfondo'=>$sfondo, ':font'=>$_POST["font"], ':b_id' => $_SESSION["edit"]));
				header("location: blog.php?blog=" . $_SESSION["edit"]);
			} catch(PDOException | Exception $e) {
				die($e->getMessage());
			}
		}
	}
