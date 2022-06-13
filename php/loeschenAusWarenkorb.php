<?php

session_start();

//Warenkorb ID holen
$sWID=$_GET['wid'];

//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
$db = new PDO($dsn,$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Aus Warenkorb entfernen
$db->prepare("DELETE FROM warenkorb WHERE wid=?")->execute([$sWID]);

//Beenden der Datenbankverbindung
$db=null;

//Weiterleitung zurück zum Warenkorb
header("Location: Warenkorb.php");
?>