<?php
	class Account
	{
		private $id;
		private $nome;
		private $premium;
		private $autenticato;

		public function __construct()
		{
			$this->id = NULL;
			$this->nome = NULL;
			$this->premium = false;
			$this->autenticato = false;
		}

		public function nuovoAccount(string $nome, string $password, string $email, string $documento, string $cellulare)
		{
			global $pdo;

			$nome = trim($nome);
			$email = trim($email);
			$documento = trim($documento);
			$cellulare = trim($cellulare);

			if(!$this->checkNome($nome)) {
				throw new Exception("Nome utente non valido");
			}
			if(!$this->checkPsw($password)) {
				throw new Exception("Password non valida");
			}
			if(!$this->checkEmail($email)) {
				throw new Exception("Email non valida");
			}
			if(!$this->checkDocumento($documento)) {
				throw new Exception("Documento non valido");
			}
			if(!$this->checkCellulare($cellulare)) {
				throw new Exception("Cellulare non valido");
			}
			if(!is_null($this->checkEmailOccupata($email))) {
				throw new Exception("Email già in uso");
			}

			try {
				$stmt = $pdo->prepare("INSERT INTO utente_registrato(nome_utente, password, email, documento, cellulare, premium, data_ora_reg)
			VALUES(:nome, :psw, :email, :documento, :cellulare, false, NOW())");
				$hashpsw = password_hash($password, PASSWORD_DEFAULT);
				$values = array(':nome' => $nome, ':psw' => $hashpsw, ':email' => $email, ':documento' => $documento, ':cellulare' => $cellulare);
				$stmt->execute($values);
			} catch(PDOException $e) {
				throw new Exception("Errore avvenuto nell'inserzione del Database" . $e);
			}

			return $pdo->lastInsertId();
		}

		public function login(string $email, string $psw): bool
		{
			global $pdo;

			$email = trim($email);
			if(!$this->checkEmail($email) || !$this->checkPsw($psw)) {
				return false;
			}

			try {
				$stmt = $pdo->prepare("
										SELECT *
										FROM utente_registrato
										WHERE email = :email");
				$stmt->execute(array(':email' => $email));
			} catch(PDOException $e) {
				throw new Exception("Errore nella query accesso al Database");
			}
			$res = $stmt->fetch();
			if(is_array($res)) {
				if(password_verify($psw, $res["password"])) {
					$this->id = $res["id_utente"];
					$this->nome = $res["nome_utente"];
					$this->autenticato = true;
					$this->premium = $res["premium"];
					$this->registraSessione();
					return true;
				}
			}
			return false;
		}

		public function loginDaSessione(): bool
		{
			global $pdo;

			if(session_status() == PHP_SESSION_ACTIVE) {
				try {
					$stmt = $pdo->prepare("
													SELECT *
													FROM sessione_utente AS s, utente_registrato AS a
													WHERE id_sessione = :s_id
													AND data_ora_login >= (NOW() - INTERVAL 7 DAY)
													AND a.id_utente = s.id_utente");
					$stmt->execute(array(':s_id' => session_id()));
				} catch(PDOException $e) {
					throw new Exception("Errore query session");
				}
				$res = $stmt->fetch();
				if(is_array($res)) {
					$this->id = $res["id_utente"];
					$this->nome = $res["nome_utente"];
					$this->autenticato = true;
					$this->premium = $res["premium"];
					return true;
				}
			}
			return false;
		}

		public function logout()
		{
			global $pdo;

			if(is_null($this->id))
			{
				return;
			}

			$this->id = NULL;
			$this->nome = NULL;
			$this->autenticato = false;
			$this->premium = false;

			if(session_status() == PHP_SESSION_ACTIVE) {
				try {
					$stmt = $pdo->prepare("
													DELETE FROM sessione_utente
													WHERE id_sessione = :s_id");
					$stmt ->execute(array(':s_id'=>session_id()));
				} catch(PDOException $e){
						throw new Exception("Errore Eliminazione sessione dal Database");
				}
			}
		}

		public function registraSessione()
		{
			global $pdo;

			if(session_status() == PHP_SESSION_ACTIVE) {
				try {
					$stmt = $pdo->prepare("
											REPLACE INTO sessione_utente(id_sessione, id_utente, data_ora_login)
											VALUES(:s_id, :id, NOW())");
					$stmt->execute(array(':s_id' => session_id(), ':id' => $this->id));
				} catch(PDOException $e) {
					throw new Exception("Registrazione sessione fallita");
				}
			}
		}

		public function checkNome(string $nome): bool
		{
			if(mb_strlen($nome) > 16) {
				return false;
			} else {
				return true;
			}
		}

		public function checkPsw(string $psw): bool
		{
			$res = true;
			if(mb_strlen($psw) > 16) {
				$res = false;
			}
			if(!preg_match("/\d+/", $psw)) {
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
			if(mb_strlen($documento) == 9) {
				return true;
			} else {
				return false;
			}
		}

		public function checkCellulare(string $cellulare): bool
		{
			if(mb_strlen($cellulare) == 10) {
				return true;
			} else {
				return false;
			}
		}

		public function checkNomeOccupato(string $nome)
		{
			global $pdo;
			try {
				$stmt = $pdo->prepare('SELECT id_utente FROM utente_registrato WHERE nome_utente = :nome');
				$stmt->bindParam(":nome", $nome);
				$stmt->execute();
				$res = $stmt->fetch();
			} catch(PDOException $e) {
				throw new Exception("Errore query Database");
			}
			return $res["id_utente"];
		}

		public function checkEmailOccupata(string $email)
		{
			global $pdo;
			try {
				$stmt = $pdo->prepare('SELECT id_utente FROM utente_registrato WHERE email = :email');
				$stmt->bindParam(":email", $email);
				$stmt->execute();
				$res = $stmt->fetch();
			} catch(PDOException $e) {
				throw new Exception("Errore query Database");
			}
			return $res["id_utente"];
		}

		public function getId(){
			return $this->id;
		}
	}

	/*
	 * TODO: Delete e Edit Account
	 * TODO: commentare
	 */