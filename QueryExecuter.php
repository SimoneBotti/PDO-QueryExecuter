<?php


	class QueryExecuter{
		private $dsn;
		private $username;
		private $password;
		
		private $pdo;
		
		function __construct($ds,$user,$pass){
			$this->dsn=$ds;
			$this->username=$user;
			$this->password=$pass;
		}
		
		function connect(){
			try{
				$this->pdo = new PDO($this->dsn, $this->username, $this->password);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo->exec('SET NAMES "utf8"');
			}catch(PDOException $e){
				$output = 'Server connection failed :' . $e->getMessage();
				echo $output;
				exit();
			}
			return $this->pdo;
		}
		

		//Function that executes query
    	//First:Query
        //Second-Infinity:Parameters
		function execute(){
			$sql=func_get_arg(0);
			try{
				$query=$sql[0];
				$s = $this->pdo->prepare($query);
				for($i=1;$i<count($sql);$i++){
					//echo $sql[$i];
					$s->bindValue(($i), $sql[$i]);
				}
				$s->execute();
			}catch(PDOException $e){
				$error = 'ERROR in research player' . $e->getMessage();
				//include 'error.html.php';
				echo "Error in Query". $e->getMessage();
				exit();
			}
			return $s;
}
		//Function that executes query
    	//First:Query
        //Second-Infinito:Parameters
		function executeSelect(){
			$sql=func_get_arg(0);
			try{
				$query=$sql[0];
				$s = $this->pdo->prepare($query);
				for($i=1;$i<count($sql);$i++){
					$s->bindValue(($i), $sql[$i]);
				}
				$s->execute();
			}catch(PDOException $e){
				$error = 'ERROR in research player' . $e->getMessage();
				//include 'error.html.php';
				echo "Error in Query". $e->getMessage();
				exit();
			}
			return $s;
}


	
	
	}
	
	
   
	
?>
