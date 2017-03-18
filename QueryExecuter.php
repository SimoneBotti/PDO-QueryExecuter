<?php
	//Call it the first time to get the PDO object
	$dsn='YOUR DSN TO DATABASE'
	$username='YOUR USERNAME';
	$password='YOUR PASSWORD';
	function connect(){
    	try{
   	   		$pdo = new PDO($dsn, $username, $password);
   	   		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   	   		$pdo->exec('SET NAMES "utf8"');
 		}catch(PDOException $e){
 	  		$output = 'Server connection failed' . $e->getMessage();
	  		exit();
		}
        return $pdo;
 	}
    //Function that executes query
    	//First:PDO
    	//Second:Query
        //Third-Infinito:Parameters
	function executeQuery(){
    	$pdo=func_get_arg(0);
        $sql=func_get_arg(1);
      try{
      		$query=$sql;
            $s = $pdo->prepare($query);
            for($i=2;$i<func_num_args();$i++){
        	 $s->bindValue(($i-1), func_get_arg($i));
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


?>
