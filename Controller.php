<?php
	require_once 'QueryExecuter.php';
	class Controller{
		public $dsn;
		public $username;
		public $password;		
		private $queryExe;
		
		function __construct($ds,$user,$pass){			$this->dsn=$ds;			$this->username=$$user;			$this->password=$pass;
			$this->queryExe=new QueryExecuter($this->dsn,$this->username,$this->password);
		}
		
		function getData(){
			$this->queryExe->connect();
			$sth=$this->queryExe->Execute(func_get_args());
			$result = $sth->fetchAll();
			return $result;
		}
		
	}

?>