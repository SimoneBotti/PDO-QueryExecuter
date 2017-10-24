<?php
	require_once 'QueryExecuter.php';
	class Controller{
		public $dsn;
		public $username;
		public $password;		
		private $queryExe;		private $rows=0;				private $Ssql="SELECT Id FROM ";		private $Esql="WHERE Email=? AND Password=?";
		
		function __construct($ds,$user,$pass){			$this->dsn=$ds;			$this->username=$$user;			$this->password=$pass;
			$this->queryExe=new QueryExecuter($this->dsn,$this->username,$this->password);
		}				function execute(){			$this->queryExe->connect();			$sth=$this->queryExe->execute(func_get_args());			if($sth==0){				return false;			}else{				return true;			}		}
		function getData(){
			$this->queryExe->connect();
			$sth=$this->queryExe->executeSelect(func_get_args());
			$result = $sth->fetchAll();			$this->rows=count($result);
			return $result;
		}		function getRowCount(){			return $this->rows;		}		function hasResult(){			if($this->rows==0){				return false;			}else{				return true;			}		}						//Function login		//Execute the query		//Return if the user is logged or not		function login($tableName,$email,$password){			$sql=$this->Ssql.$tableName.$this->Esql;			$result=$this->getData($sql,$email,$password);			if($this->getRowCount()==1){				return 1;			}else{				return 0;			}		}
		
	}

?>