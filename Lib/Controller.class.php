<?php

	require_once 'QueryExecuter.class.php';
	require_once 'Record.class.php';

	class Controller{

		private $dsn = "";
		private $username = "";
		private $password = "";
		
		private $queryExe;
		private $rows = 0;
		
		private $Ssql = "SELECT Id FROM ";
		private $Esql = " WHERE Email = ? AND Password = ?";
		

		/*
		 * Costruttore della classe
		 * 
		 * @param string $ds 
		 *        stringa contenente i valori di connessione al database (vedi classe PDO)
		 * 
		 * @param string $user 
		 *        username dell'utente che tenta una connessione
		 * 
		 * @param string $pass
		 *        password associata all'utente che tenta la connessione
		 */
		public function __construct(string $ds, string $user, string $pass)
		{
			$this->dsn = $ds;
			$this->username = $user;
			$this->password = $pass;
			$this->queryExe = new QueryExecuter($this->dsn, $this->username, $this->password);

		}

		/*
		 * Funzione getter
		 * 
		 * @param string arg0
		 *        nome del valore che si vuole ottenere
		 * 
		 * @return $property
		 * 		   valore della proprietà richiesta
		 */
		public function __get(string $property)
		{
			if(property_exists($this, $property))
				return $this->$property;
		}
		
		/*
		 * Esegue un comando sul DB, ad eccezione di 'SELECT' (vedi getData())
		 * 
		 * @param string arg0
		 *        stringa che contiene il comando SQL da eseguire, con i valori sostituiti da '?'
		 * 
		 * @param string arg0...argN
		 *        valori da sostituire ai '?' precedenti, in ordine di come appaiono
		 * 
		 * @return bool
		 * 		   Un booleano che rappresenta la riuscita o meno del comando 		 
		 */
		public function execute(): bool
		{
			$this->queryExe->connect();
			$sth = $this->queryExe->execute(func_get_args());
			return $sth;
		}

		public function getData(): array
		{
			$this->queryExe->connect();
			$sth = $this->queryExe->executeSelect(func_get_args());
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			$this->rows = count($result);

			if($this->rows == 1)
				return $result[0];
			else
				return $result;
			
		}

		public function getRowCount(): int
		{
			return $this->rows;
		}

		public function hasResult(): bool
		{
			if($this->rows == 0)
				return false;
			else
				return true;
			
		}

		//Function that check if a Query has a result
		public function sqlHasResult(): bool
		{
			$this->queryExe->connect();
			$sth=$this->queryExe->executeSelect(func_get_args());
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			$this->rows = count($result);

			return $this->hasResult();
		}
			
		//Function login
		//Execute the query
		//Return if the user is logged or not
		public function login(string $tableName, string $email, string $password): string 
		{
			$sql = $this->Ssql.$tableName.$this->Esql;

			$result=$this->getData($sql, $email, $password);

			if($this->getRowCount() == 1)
				return $result[0];
			else
				return "NONE";
		}

		/**
		 * Function Exists
		 * check if the value exist in the row of the table given
		 * If exists return how many times
		 */
		public function exists(string $tableName, string $column, $value)
		{
			$sql = $this->costructSqlExist($tableName, $column);
			$this->getData($sql, $value);

			if($this->getRowCount() > 0)
				return $this->getRowCount();
			else
				return false;
			
		}

		/**
		 * Function constructSqlExist
		 * create the sql to check if the value exist
		 */
		private function costructSqlExist(string $tableName, string $column): string
		{
			$sql = "SELECT ".$column." FROM ".$tableName." WHERE ".$column." = ?";
			return $sql;
		}

		public function getRecord(): Record
		{
			$args = func_get_args();

			$arrayFromDatabase = call_user_func_array(array(&$this, "getData"), $args);
			$record = new Record($arrayFromDatabase);
			$record->setController($this);

			return $record;
		}

	}



?>
