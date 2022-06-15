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


$query=$conn->prepare("SELECT * FROM warenkorb WHERE pid= ?");
$query->execute([$sPID]);
$result = $query->rowCount();


if ($sPMenge>0 AND $result>0 AND $sAnzahl<=$sPMenge) {
    //Produktanzahl aktualisieren
        $sqlwarenkorb3=$conn->prepare("UPDATE warenkorb SET panzahl=panzahl+$sAnzahl WHERE pid= ?");
        $sqlwarenkorb3->execute([$sPID]);
        //SQL Produkte Bestand verändern
        $sqlprodukte=$conn->prepare("UPDATE produkte SET menge=menge-$sAnzahl WHERE id= ?");
        $sqlprodukte->execute([$sPID]);
        //SQL Warenkorb Summe updaten wenn das Produkt schon im Warenkorb ist
        $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis WHERE pid= ?");
        $sqlwarenkorbsumme->execute([$sPID]);
        //Beenden der DatenbankVerbindung
        $conn=null;

        //Weiterleitung zur Artikelübersicht
        header("Location: Artikelseite.php");
} 
if($sPMenge>0 AND $result==0 AND $sAnzahl<=$sPMenge) 
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
        //SQL Menge im Bestand verändern
        $sqlprodukte2=$conn->prepare("UPDATE produkte SET menge=menge-$sAnzahl WHERE id= ?");
        $sqlprodukte2->execute([$sPID]);
        //SQL Warenkorb Summe updaten beim ersten einsetzen des Produktes
        $sqlwarenkorbsumme2=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis WHERE pid= ?");
        $sqlwarenkorbsumme2->execute([$sPID]);

        //Beenden der DatenbankVerbindung
        $conn=null;

        //Weiterleitung zur Artikelübersicht
        header("Location: Artikelseite.php");
                 
}
else {
    header("Location: produktNichtVerfuegbar.php");
}


   
    
    

//Beenden der DatenbankVerbindung
$conn=null;

// //Weiterleitung zur Artikelübersicht
// header("Location: Artikelseite.php");

?>