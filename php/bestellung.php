<?php
session_start();

error_reporting(-1);
ini_set('display_errors','On');

//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$db = new PDO($dsn,$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$userid=$_SESSION['id'];
$userwaren ="SELECT * FROM warenkorb WHERE userid=$userid" AND wid=$wid;

$result = $db->query($wid);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellung</title>
</head>
<body>
    
</body>
</html>