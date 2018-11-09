<?php
    require_once 'Controller.class.php';

    $dsn = "mysql:host=localhost;dbname=DBNAME";
    $user = "root";
    $pass = "";

    $controller = new Controller($dsn, $user, $pass);


?>
