<?php
	require "db_handler.php";
	$pdo = db_connect();

	class Account
	{
		private $id;
		private $nome;
		private $email;
		private $documento;
		private $cellulare;
		private $premium;
		private $autenticato;

		public function __construct()
		{
			$this->id = NULL;
			$this->nome = NULL;
			$this->email = NULL;
			$this->documento = NULL;
			$this->cellulare = NULL;
			$this->premium = false;
			$this->autenticato = false;
		}

		public function nuovoAccount(string $nome, string $password, string $email, string $documento, int $cellulare)
		{
			global $pdo;

			$nome = trim($nome);
			$email = trim($email);
			$documento = trim($documento);


			if (!$this->checkNome($nome)) {
				throw new Exception("Nome utente non valido");
			}
			if (!$this->checkPsw($password)) {
				throw new Exception("Password non valida");
			}
			if(!$this->checkEmail($email)){
				throw new Exception("Email non valida");
			}
			if(!$this->checkDocumento($documento)){
				throw new Exception("Documento non valido");
			}
			if(!$this->checkCellulare($cellulare)){
				throw new Exception("Cellulare non valido");
			}
			if(!is_null($this->checkNomeOccupato($nome))){
				throw new Exception("Nome utente non disponibile");
			}
			if(!is_null($this->checkEmailOccupata($email))){
				throw new Exception("Email già in uso");
			}

			try {
				$stmt = $pdo -> prepare("INSERT INTO utente_registrato(nome_utente, password, email, documento, cellulare, premium)
			VALUES(:nome, :psw, :email, :documento, :cellulare, false)");
				$hashpsw = password_hash($password, PASSWORD_DEFAULT);
				$values = array(':nome' => $nome, ':psw' => $hashpsw, ':email' => $email, ':documento' => $documento, ':cellulare' => $cellulare);
				$stmt -> execute($values);
			} catch (PDOException $e) {
				Throw new Exception("Errore avvenuto nell'inserzione del Database" . $e);
			}


			return $pdo->lastInsertId();
		}

		public function checkNome(string $nome): bool
		{
			if (mb_strlen($nome) > 16) {
				return false;
			} else {
				return true;
			}
		}

		public function checkPsw(string $psw): bool
		{
			$res = true;
			if (mb_strlen($psw) > 16) {
				$res = false;
			}
			if (!preg_match("/\d+/", $psw)) {
				$res = false;
			}
			return $res;
		}

		public function checkEmail(string $email): bool
		{
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}

		public function checkDocumento(string $documento): bool
		{
			if (mb_strlen($documento) == 9) {
				return true;
			} else {
				return false;
			}
		}

		public function checkCellulare(int $cellulare): bool
		{
			if (mb_strlen((string)$cellulare) == 10) {
				return true;
			} else {
				return false;
			}
		}

		public function checkNomeOccupato(string $nome)
		{
			global $pdo;
			try{
				$stmt = $pdo -> prepare('SELECT id_utente FROM utente_registrato WHERE nome_utente = :nome');
				$stmt -> bindParam(":nome", $nome);
				$stmt -> execute();
				$res = $stmt -> fetch();
			} catch (PDOException $e) {
				Throw new Exception("Errore query Database");
			}
			return $res["id_utente"];
		}

		public function checkEmailOccupata(string $email)
		{
			global $pdo;
			try{
				$stmt = $pdo -> prepare('SELECT id_utente FROM utente_registrato WHERE email = :email');
				$stmt -> bindParam(":email", $email);
				$stmt -> execute();
				$res = $stmt -> fetch();
			} catch (PDOException $e) {
				Throw new Exception("Errore query Database");
			}
			return $res["id_utente"];
		}
	}

	$account = new Account();
	try{
		$id = $account->nuovoAccount("Sofia", "porcodio123", "ciao2@gmail.com", "AX12345BB", 3332241110);
		echo $id;
	} catch(Exception $e) {
		echo $e -> getMessage();
		die();
	}


	/*
	 * TODO: Delete e Edit Account
	 */