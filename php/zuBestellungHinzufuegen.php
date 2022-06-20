<?php
 session_start();

 //Datenfelder für Daten
    $sUserId=$_SESSION['id'];
    $sPID="";
    $sTitel="";
    $sPreis="";
    $sMenge="";
    $sAuswahl="";
    $sSumme="";

//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Daten der Produkte aus der Datenbank holen
$sql ="SELECT * FROM warenkorb WHERE userid=$sUserId";

//Bestellnr generieren
include "bestellnr.php";
$genbnr=bnrGenerator(9);

foreach($conn->query($sql) as $row)
{
            $sPID=$row['pid'];
            $sTitel=$row['ptitel'];
            $sPreis=$row['ppreis'];
            $sMenge=$row['panzahl'];
            $sSumme=$row['psumme'];

            $sqlbestellung= $conn->query($sql);
            //SQL Produkte der Bestellung hinzufügen
            $sqlbestellung="INSERT INTO bestellung (userid,pid,preis,titel,menge,summe,bestellnr)
            VALUES(?,?,?,?,?,?,?)";
            $stmt3=$conn->prepare($sqlbestellung);
            $stmt3->execute([$sUserId,$sPID,$sPreis,$sTitel,$sMenge,$sSumme,$genbnr]);
}

//Beenden der DatenbankVerbindung
$conn=null;

//Weiterleitung 
header("Location: Checkout.php");

?>