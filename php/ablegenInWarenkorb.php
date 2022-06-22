<?php
 session_start();

 //Daten von ausgewähltem Produkt übernehmen
    $sUserId=$_SESSION['id'];
    $sPID=$_GET['pid'];
    $sPTitel="";
    $sPPreis="";
    $sPMenge="";
    $sPBildlink="";
    $sAuswahl="";

//Anzahl Übergabe
$sAnzahl="";
if(isset($_POST['anzahl']))
    {
        $sAnzahl=($_POST['anzahl']);
    }


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
            $sPMenge=$row['menge'];
        }


$query=$conn->prepare("SELECT * FROM warenkorb WHERE pid= ? AND userid= ?");
$query->execute([$sPID,$sUserId]);
$result = $query->rowCount();


if ($sPMenge>0 AND $result>0 AND $sAnzahl<=$sPMenge) {
        //Produktanzahl aktualisieren
        $sqlwarenkorb3=$conn->prepare("UPDATE warenkorb SET panzahl=panzahl+$sAnzahl WHERE pid= ?");
        $sqlwarenkorb3->execute([$sPID]);
        //SQL Warenkorb Summe updaten wenn das Produkt schon im Warenkorb ist
        $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis WHERE pid= ?");
        $sqlwarenkorbsumme->execute([$sPID]);

        //Weiterleitung zur Artikelübersicht
        header("Location: Artikelseite.php");
} 
if($sPMenge>0 AND $sAnzahl<=$sPMenge) 
{
    $sqlwarenkorb= $conn->query($pinfo);
        //SQL Produkte in den Warenkorb legen
        $sqlwarenkorb="INSERT INTO warenkorb (pid,userid,ptitel,ppreis,pbildlink)
        VALUES(?,?,?,?,?)";
         $stmt3=$conn->prepare($sqlwarenkorb);
         $stmt3->execute([$sPID,$sUserId,$sPTitel,$sPPreis,$sPBildlink]);
        //SQL Warenkorb Anzahl bearbeiten
         $sqlwarenkorb2=$conn->prepare("UPDATE warenkorb SET panzahl=panzahl+$sAnzahl WHERE pid= ?");
         $sqlwarenkorb2->execute([$sPID]);
        //SQL Warenkorb Summe updaten beim ersten einsetzen des Produktes
        $sqlwarenkorbsumme2=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis WHERE pid= ?");
        $sqlwarenkorbsumme2->execute([$sPID]);

        //Rabatt anwenden bei Menge von 8+
        if ($sPMenge>=8 && $sPMenge<16) {
            $sqlwarenkorbpreis=$conn->prepare("UPDATE warenkorb SET psumme=psumme*(92/100) WHERE pid= ?");
            $sqlwarenkorbpreis->execute([$sPID]);
        }

        //Weiterleitung zur Artikelübersicht
        header("Location: Artikelseite.php");
                 
}
else {

    //echo "Das Produkt ist leider nicht mehr verfügbar";
    header("Location: produktNichtVerfuegbar.php");
}

//Rabatt wenn 8 desselben Artikels gekauft werden 8%, bei 16 artikel 16%
$query=("SELECT panzahl FROM warenkorb WHERE pid= $sPID");

foreach($conn->query($query) as $row)
    {
        $sPMenge=$row['panzahl']; 
    }
    
if ($sPMenge >= 8) {
    $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis*0.92 WHERE pid= ?");
    $sqlwarenkorbsumme->execute([$sPID]);
}

if ($sPMenge >= 16) {
    $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis*0.84 WHERE pid= ?");
    $sqlwarenkorbsumme->execute([$sPID]);
}


   
    
    

//Beenden der DatenbankVerbindung
$conn=null;

// //Weiterleitung zur Artikelübersicht
// header("Location: Artikelseite.php");

?>