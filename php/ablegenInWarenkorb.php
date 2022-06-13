<?php
 session_start();

 //Daten von ausgewähltem Produkt übernehmen
    $sUserId=$_SESSION['id'];
    $sPID=$_GET['pid'];
    $sPTitel="";
    $sPPreis="";
    //$sPAnzahl=$_GET['anzahl'];
    $sPBildlink="";
    $sAuswahl="";


//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Daten der Produkte aus der Datenbank holen
$pinfo ="SELECT * FROM produkte WHERE id=$sPID";



foreach($conn->query($pinfo) as $row)
        {
            $sPTitel=$row['titel'];
            $sPPreis=$row['preis'];
            $sPBildlink=$row['bildlink'];
        }

$sqlwarenkorb= $conn->query($pinfo);

    //SQL Produkte in den Warenkorb legen
        $sqlwarenkorb="INSERT INTO warenkorb (pid,userid,ptitel,ppreis,pbildlink)
        VALUES(?,?,?,?,?)";
         $stmt3=$conn->prepare($sqlwarenkorb);
         $stmt3->execute([$sPID,$sUserId,$sPTitel,$sPPreis,$sPBildlink]);

//Beenden der DatenbankVerbindung
$conn=null;

//Weiterleitung zur Artikelübersicht
header("Location: Artikelseite.php");

?>