<?php
session_start();

  // error_reporting(-1);
  // ini_set('display_errors','On');
  
//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
$db = new PDO($dsn,$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$userid=$_SESSION['id'];
$userwaren ="SELECT * FROM bestellt WHERE userid=$userid";

$result = $db->query($userwaren);

 foreach($db->query($userwaren) as $row)
       {
        $sVorname=$row['vorname'];
        $sNachname=$row['nachname'];
        $sStraße=$row['straße'];
        $sEmail=$row['email'];
        $sZusatz=$row['zusatz'];
        $sLand=$row['land'];
        $sOrt=$row['ort'];
        $sPlz=$row['plz'];
        $sPid=$row['pid'];
        $sTitel=$row['titel'];
        $sPreis=$row['preis'];
        $sMenge=$row['menge'];
        $sSumme=$row['summe'];
        $sBestellNr=$row['bestellnr'];
        $sBildlink=$row['bildlink'];

        
        //SQL Produkte der Bestellung hinzufügen
        $sqlbestellung="INSERT INTO bestellt (vorname,nachname,straße,email,zusatz,land,ort,plz,userid,pid,preis,titel,menge,summe,bestellnr,bildlink)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt3=$db->prepare($sqlbestellung);
        $stmt3->execute([$sVorname,$sNachname,$sStraße,$sEmail,$sZusatz,$sLand,$sOrt,$sPlz,$userid,$sPid,$sPreis,$sTitel,$sMenge,$sSumme,$sBestellNr,$sBildlink]);

        //SQL Menge im Bestand verändern
        $sqlprodukte2=$db->prepare("UPDATE produkte SET menge=menge-$sMenge WHERE id= ?");
        $sqlprodukte2->execute([$sPid]);

       }

// PHP-Mailer
include "../PHPMailer/BusinessMail.php";

//Beenden der DatenbankVerbindung
$conn=null;

//Weiterleitung 
header("Location: danke.php");

?>