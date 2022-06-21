<?php
 session_start();

 $sUserId=$_SESSION['id'];
 $sVorname="";
 $sNachname="";
 $sEmail="";
 $sStraße="";
 $sZusatz="";
 $sLand="";
 $sOrt="";
 $sPlz="";
 $sPid="";
 $sPreis="";
 $sTitel="";
 $sMenge="";
 $sSumme="";
 $sBestellNr="";
 $bOrderSuccess=false;

 if(isset($_POST['vorname']))
 {
     $sVorname=($_POST['vorname']);
 }
 if(isset($_POST['nachname']))
 {
     $sNachname=($_POST['nachname']);
 }
 if(isset($_POST['straße']))
 {
     $sStraße=($_POST['straße']);
 }
 if(isset($_POST['email']))
 {
     $sEmail=($_POST['email']);
 }
 if(isset($_POST['zusatz']))
 {
     $sZusatz=($_POST['zusatz']);
 }
 if(isset($_POST['land']))
 {
     $sLand=($_POST['land']);
 }
 if(isset($_POST['ort']))
 {
     $sOrt=($_POST['ort']);
 }
 if(isset($_POST['plz']))
 {
     $sPlz=($_POST['plz']);
 }

//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$conn = new PDO($dsn,$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Daten der Produkte zur Bestellung holen
$produkte ="SELECT * FROM bestellung WHERE userid=$sUserId";

$sqlbestellung= $conn->query($produkte);

    foreach($conn->query($produkte) as $row)
{
            $sPid=$row['pid'];
            $sTitel=$row['titel'];
            $sPreis=$row['preis'];
            $sMenge=$row['menge'];
            $sSumme=$row['summe'];
            $sBestellNr=$row['bestellnr'];

            
            //SQL Produkte der Bestellung hinzufügen
            $sqlbestellung="INSERT INTO bestellt (vorname,nachname,straße,email,zusatz,land,ort,plz,userid,pid,preis,titel,menge,summe,bestellnr)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt3=$conn->prepare($sqlbestellung);
            $stmt3->execute([$sVorname,$sNachname,$sStraße,$sEmail,$sZusatz,$sLand,$sOrt,$sPlz,$sUserId,$sPid,$sPreis,$sTitel,$sMenge,$sSumme,$sBestellNr]);

            //Warenkorb leeren
            $conn->prepare("DELETE FROM warenkorb WHERE userid=?")->execute([$sUserId]);

            //Bestellung Datenbank leeren
            $conn->prepare("DELETE FROM bestellung WHERE userid=?")->execute([$sUserId]);

            // $bOrderSuccess=true;
}

// if ($bOrderSuccess=true) {
//     //Warenkorb leeren 
    
// }
// else {
//     echo "Die Bestellung hat leider nicht funktioniert!";
// }


// PHP-Mailer
include "../PHPMailer/BusinessMail.php";


//Beenden der DatenbankVerbindung
$conn=null;

// //Weiterleitung zur Artikelübersicht
header("Location: danke.php");

?>
