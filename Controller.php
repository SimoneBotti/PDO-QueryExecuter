<?php
	require_once 'QueryExecuter.php';
	class Controller{
		
		public $dsn='mysql:host=localhost;dbname=my_sitoarticoli';
		public $username='localhost';
		public $password='';
		
		private $queryExe;
		
		function __construct(){
			$this->queryExe=new QueryExecuter($this->dsn,$this->username,$this->password);
		}
		
		function getData($sql){
			$this->queryExe->connect();
			$sth=$this->queryExe->Execute($sql);
			$result = $sth->fetchAll();
			return $result;
		}
		
	}

?>