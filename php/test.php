<?php
 session_start();

 $neueMenge = $_GET["jsvar"]; // Übergabe von Warenkorb Anzahl
 $sPID = $_GET['pid'];
 echo $sPID;

//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($neueMenge>0) {
    //Produktanzahl aktualisieren
    $sqlwaren=$conn->prepare("UPDATE warenkorb SET panzahl=$neueMenge WHERE pid= ?");
    $sqlwaren->execute([$sPID]);
    //SQL Produkte Bestand verändern
    
} 
else 
{
    
}


?>