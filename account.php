<?php

	class Account
	{
		private $id;
		private $nome;
		private $autenticato;

		public function __construct()
		{
			$this->id = NULL;
			$this->nome = NULL;
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
				throw new Exception("Password non valida! Seguire il formato richiesto!");
			}
			if(!$this->checkEmail($email)) {
				throw new Exception("Email non valida! Controlla di aver inserito correttamente il dominio dopo la @!");
			}
			if(!$this->checkDocumento($documento)) {
				throw new Exception("Documento non valido! Un documento è una stringa di 9 cifre!");
			}
			if(!$this->checkCellulare($cellulare)) {
				throw new Exception("Cellulare non valido! Inserisci soltanto il numero senza il prefisso +39. I numeri italiani sono composti da 10 cifre!");
			}
			if(!is_null($this->checkEmailOccupata($email))) {
				throw new Exception("Email già in uso");
			}

			try {
				$stmt = $pdo->prepare("INSERT INTO utente_registrato(nome_utente, password, email, documento, cellulare, data_ora_reg)
			VALUES(:nome, :psw, :email, :documento, :cellulare, NOW())");
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
					return true;
				}
			}
			return false;
		}

		public function logout()
		{
			global $pdo;

			if(is_null($this->id)) {
				return;
			}

			$this->id = NULL;
			$this->nome = NULL;
			$this->autenticato = false;

			if(session_status() == PHP_SESSION_ACTIVE) {
				try {
					$stmt = $pdo->prepare("
													DELETE FROM sessione_utente
													WHERE id_sessione = :s_id");
					$stmt->execute(array(':s_id' => session_id()));
				} catch(PDOException $e) {
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

		public function modificaAccount(string $nome, string $password, string $email, string $documento, string $cellulare)
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
				throw new Exception("Password non valida! Seguire il formato richiesto!");
			}
			if(!$this->checkEmail($email)) {
				throw new Exception("Email non valida! Controlla di aver inserito correttamente il dominio dopo la @!");
			}
			if(!$this->checkDocumento($documento)) {
				throw new Exception("Documento non valido! Un documento è una stringa di 9 cifre!");
			}
			if(!$this->checkCellulare($cellulare)) {
				throw new Exception("Cellulare non valido! Inserisci soltanto il numero senza il prefisso +39. I numeri italiani sono composti da 10 cifre!");
			}
			if($this->id != $this->checkEmailOccupata($email)) {
				throw new Exception("Email già in uso");
			}

			try {
				$stmt = $pdo->prepare("
												UPDATE utente_registrato
												SET nome_utente = :nome,
												password = :psw,
												email = :email,
												documento = :documento,
												cellulare = :cellulare
												WHERE id_utente = :id");
				$stmt->execute(array(
					':nome' => $nome,
					':psw' => password_hash($password, PASSWORD_DEFAULT),
					':email' => $email,
					':documento' => $documento,
					':cellulare' => $cellulare,
					':id' => $this->id
				));
				return true;
			} catch(PDOException $e) {
				throw new Exception("Impossibile aggiornare i dati utente" . $e->getMessage());
			}
		}

		public function cancellaAccount()
		{
			global $pdo;
			try {
				$stmt = $pdo->prepare("DELETE FROM utente_registrato WHERE id_utente = :id");
				$stmt->execute(array(':id' => $this->getId()));
				return true;
			} catch(PDOException $e) {
				throw new Exception ("Errore durante eliminazione dell'account.php" . $e->getMessage());
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

		public function getId()
		{
			return $this->id;
		}

		public function getNome()
		{
			return $this->nome;
		}

		public function getDatiUtente()
		{
			global $pdo;
			try {
				$stmt = $pdo->prepare("SELECT email, documento, cellulare FROM utente_registrato WHERE id_utente = :id");
				$stmt->execute(array(':id' => $this->id));
				return $stmt->fetch();
			} catch(PDOException $e) {
				throw new Exception("impossibile recuperare i dati utente");
			}
		}

	}

	/*
	 * TODO: Edit Account
	 */