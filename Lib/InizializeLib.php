<?php
    require_once 'Controller.class.php';

    $dsn = "mysql:host=localhost;dbname=DBNAME";
    $user = "USERNAME";
    $pass = "PASSWORD";

    $controller = new Controller($dsn, $user, $pass);


?>
