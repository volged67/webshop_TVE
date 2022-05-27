<?php

$dsn='mysql:dbname=webshop;host=localhost';
$username='root';
$password='';

$con =new PDO($dsn,$username,$password);

$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>