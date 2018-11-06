<?php

	require_once 'QueryExecuter.php';

	class Controller{

		public $dsn;
		public $username;
		public $password;
		
		private $queryExe;
		private $rows=0;
		
		private $Ssql="SELECT Id FROM ";
		private $Esql=" WHERE Email=? AND Password=?";
		

		function __construct($ds,$user,$pass){
			$this->dsn=$ds;
			$this->username=$$user;
			$this->password=$pass;
			$this->queryExe=new QueryExecuter($this->dsn,$this->username,$this->password);

		}
		
		function execute(){
			$this->queryExe->connect();
			$sth=$this->queryExe->execute(func_get_args());
			if($sth==0){
				return false;
			}else{
				return true;
			}
		}

		function getData(){
			$this->queryExe->connect();
			$sth=$this->queryExe->executeSelect(func_get_args());
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$this->rows=count($result);
			if($this->rows==1){
				return $result[0];
			}else{
				return $result;
			}
		}
		function getRowCount(){
			return $this->rows;
		}
		function hasResult(){
			if($this->rows==0){
				return false;
			}else{
				return true;
			}
		}
		//Function that check if a Query has a result
		function sqlHasResult(){
			$this->queryExe->connect();
			$sth=$this->queryExe->executeSelect(func_get_args());
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$this->rows=count($result);
			return $this->hasResult();
		}
		
		
		//Function login
		//Execute the query
		//Return if the user is logged or not
		function login($tableName,$email,$password){
			$sql=$this->Ssql.$tableName.$this->Esql;
			$result=$this->getData($sql,$email,$password);
			if($this->getRowCount()==1){
				return $result[0];
			}else{
				return 0;
			}
		}
		/**
		 * Function Exists
		 * check if the value exist in the row of the table given
		 * If exists return how many times
		 */
		function exists($tableName,$column,$value){
			$sql=constructSqlExist($tableName,$columnm,$value);
			$result=$this->getData($sql,$value);
			if($this->getRowCount()>0){
				return this->getRowCount();
			}else{
				return false;
			}
		}
		/**
		 * Function constructSqlExist
		 * create the sql to check if the value exist
		 */
		function costructSqlExist($tableName,$column,$value){
			$sql="SELECT ".$column." FROM ".$tableName." WHERE ".$column." = ?";
			return $sql;
		}

	}



?>
