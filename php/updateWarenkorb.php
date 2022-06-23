<?php
$sPID=$_GET["pid"];

//DB Settings
          include 'dbsettings.php';

          //Verbindung zur Datenbank
          $conn = new PDO($dsn,$username,$password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Daten der Produkte aus der Datenbank holen
$pinfo ="SELECT * FROM produkte WHERE id=$sPID";

foreach($conn->query($pinfo) as $row)
        {
            $sPMenge=$row['menge'];
        }



$sAnzahl="";
if(isset($_POST['quantity']))
    {
        $sAnzahl=($_POST['quantity']);
    }

if ($sAnzahl>$sPMenge) {
    header("Location: produktNichtVerfuegbar.php");
} else {
     // Falls artikelmenge auf unter 1 gesetzt wird entferne artikel von warenkorb ansonsten update warenkorb
      if($_POST['quantity']<1){
        $sqlEntferneArtikel= "DELETE FROM warenkorb WHERE pid=$sPID";              
        $abfrage = $conn->prepare($sqlEntferneArtikel);
        $abfrage->execute();
    
        //SQL Warenkorb Summe updaten wenn das Produkt schon im Warenkorb ist
        $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis WHERE pid= ?");
        $sqlwarenkorbsumme->execute([$sPID]);
      }
      else{
      
      // Verändere die menge von cart um die Menge vom input feld
      $sqlÄndereArtikelMenge= "UPDATE warenkorb SET panzahl =$sAnzahl  WHERE warenkorb.pid=$sPID";                     
      $abfrage = $conn->prepare($sqlÄndereArtikelMenge);
      $abfrage->execute();


      //SQL Warenkorb Summe updaten wenn das Produkt schon im Warenkorb ist
      $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis WHERE pid= ?");
      $sqlwarenkorbsumme->execute([$sPID]);
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
            //Rabatt hinzufügen in der Tabelle
            $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET rabatt=8.0 WHERE pid= ?");
            $sqlwarenkorbsumme->execute([$sPID]);
      }
       if ($sPMenge >= 16) {
          $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis*0.84 WHERE pid= ?");
          $sqlwarenkorbsumme->execute([$sPID]);
              //Rabatt hinzufügen in der Tabelle
            $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET rabatt=16.0 WHERE pid= ?");
            $sqlwarenkorbsumme->execute([$sPID]);
      }
      if ($sPMenge < 8) {
          //Rabatt hinzufügen in der Tabelle
          $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET rabatt=0.0 WHERE pid= ?");
          $sqlwarenkorbsumme->execute([$sPID]);
    }

    // Close connection
    $conn = null;
    
    

header("Location: Warenkorb.php");
}


     

?>