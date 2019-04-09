<?php

	
	class QueryExecuter{
		private $dsn;
		private $username;
		private $password;
		
		private $pdo;
		
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
		}
		
		/*
		 * Tenta una connessione al DB usando i dati passati nel costruttore
		 * 
		 * @return PDOStatement
		 */
		public function connect()
		{
			try{
				$this->pdo = new PDO($this->dsn, $this->username, $this->password);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo->exec('SET NAMES "utf8"');
			}catch(PDOException $e){
				$output = 'Server connection failed: ' . $e->getMessage();
				echo $output;
				exit();
			}
			return $this->pdo;
		}
		
		/*
		 * Esegue un comando sul database
		 * 
		 * La funzione va bene per qualsiasi comando ad esclusione di 'SELECT' (per quello vedi executeSelect())
		 * In caso di eccezione, la funzione termina scrivendo la stringa in output
		 * 
		 * @param string arg0
		 *        stringa contenente l'SQL da eseguire, ma con i valori sostituiti da '?'
		 * 
		 * @param mixed arg1...argN 
		 *        valore da sostituire ad i '?' del precedente SQL, in ordine esatto di come appaiono
		 * 
		 * @return bool
		 *         true se il comando è stato eseguito correttamente, false in caso contrario
         */
		public function execute(): bool
		{
			$sql = func_get_arg(0);
			$ok = false;

			try{
				$query = $sql[0];
				$s = $this->pdo->prepare($query);

				for($i = 1; $i < count($sql); $i++)
				{
					$ok = $s->bindValue(($i), $sql[$i]);
				}

				$ok = $s->execute();
			}catch(PDOException $e){
				echo "Error in Query: ". $e->getMessage();
				exit();
			}

			return $ok;
		}

		/*
		 * Esegue un comando sul database
		 * 
		 * La funzione accetta solo comandi 'SELECT'
		 * In caso di eccezione, la funzione ritorna false, dopo aver scritto in output l'errore
		 * 
		 * @param string arg0
		 *        stringa contenente l'SQL da eseguire, ma con i valori sostituiti da '?'
		 * 
		 * @param mixed arg1...argN 
		 *        valore da sostituire ad i '?' del precedente SQL, in ordine esatto di come appaiono
		 * 
		 * @return string 
		 *         ritorna il risultato della query
         */
		public function executeSelect(): PDOStatement
		{
			$sql = func_get_arg(0);
			$ok = false;
			
			try{
				$query = $sql[0];
				$s = $this->pdo->prepare($query);
				for($i = 1; $i < count($sql); $i++)
				{
					$ok = $s->bindValue(($i), $sql[$i]);
				}
				$ok = $s->execute();

			}catch(PDOException $e){
				echo "Error in Query". $e->getMessage();
				return $ok;
			}
			return $s;
		}

	}
		
?>
