<?php
	require_once 'QueryExecuter.php';
	class Controller{
		public $dsn;
		public $username;
		public $password;		
		private $queryExe;		private $rows=0;
		
		function __construct($ds,$user,$pass){			$this->dsn=$ds;			$this->username=$$user;			$this->password=$pass;
			$this->queryExe=new QueryExecuter($this->dsn,$this->username,$this->password);
		}
		
		function getData(){
			$this->queryExe->connect();
			$sth=$this->queryExe->Execute(func_get_args());
			$result = $sth->fetchAll();			$this->rows=count($result);
			return $result;
		}		function getRowCount(){			return $this->rows;		}		function hasResult(){			if($this->rows==0){				return false;			}else{				return true;			}		}
		
	}

?>