<?php
	require_once 'Controller.php';
    require_once 'Query.php';
    
    $dsn='mysql:host=localhost;dbname=YOURDBNAME';
	$user="YOUR USERNAME";
	$pass="YOUR PASSWORD";
    $controller=new Controller($dsn,$user,$pass);


?>