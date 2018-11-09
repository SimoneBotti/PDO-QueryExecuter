<?php


	class QueryExecuter{
		private $dsn;
		private $username;
		private $password;
		
		private $pdo;
		
		public function __construct(string $ds, string $user, string $pass)
		{
			$this->dsn = $ds;
			$this->username = $user;
			$this->password = $pass;
		}
		
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
		
		//Function that executes query
    	//First:Query
        //Second-Infinity:Parameters
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

		//Function that executes query
    	//First:Query
        //Second-Infinite:Parameters
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
