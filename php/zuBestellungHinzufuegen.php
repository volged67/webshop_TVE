<?php
 session_start();

 //Datenfelder für Daten
    $sUserId=$_SESSION['id'];
    $sPID="";
    $sPTitel="";
    $sPPreis="";
    $sPMenge="";
    $sAuswahl="";

//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Daten der Produkte aus der Datenbank holen
$sql ="SELECT * FROM warenkorb WHERE userid=$sUserId";

echo $sql;

foreach($conn->query($sql) as $row)
{
            $sPID=$row['pid']
            //$sPTitel=$row['ptitel'];
            //$sPPreis=$row['ppreis'];
            //$sPMenge=$row['panzahl'];
}

        

//Bestellnr generieren
include "bestellnr.php";
$genbnr=bnrGenerator(9);

        $sqlbestellung= $conn->query($sql);
        //SQL Produkte der Bestellung hinzufügen
        $sqlbestellung="INSERT INTO bestellung (pid,userid,titel,preis,menge,bestellnr)
        VALUES(?,?,?,?,?,?)";
         $stmt3=$conn->prepare($sqlbestellung);
         $stmt3->execute([$sPID,$sUserId,$sPTitel,$sPPreis,$sPMenge,$genbnr]);

        //Beenden der DatenbankVerbindung
        $conn=null;


//Beenden der DatenbankVerbindung
$conn=null;

//Weiterleitung 
// header("Location: Artikelseite.php");

?>