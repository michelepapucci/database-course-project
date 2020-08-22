<?php
	require "db_handler.php";

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
			$pdo = db_connect();
			if(!$this->checkNome($nome)){
				throw new Exception("Nome utente non valido");
			}
			if(!$this->checkPsw($password)){
				throw new Exception("Password non valida");
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
			if(!preg_match("/\d+/", $psw)){
				$res = false
			}
			return $res;
		}

	}