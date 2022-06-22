<?php
$sPID=$_GET["pid"];

// if(isset($_POST['quantity'])){
//     $sNeueMenge($_POST['quantity']);
// }
$sAnzahl="";
if(isset($_POST['quantity']))
    {
        $sAnzahl=($_POST['quantity']);
    }

try{
          //DB Settings
          include 'dbsettings.php';

          //Verbindung zur Datenbank
          $conn = new PDO($dsn,$username,$password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
      }
       if ($sPMenge >= 16) {
          $sqlwarenkorbsumme=$conn->prepare("UPDATE warenkorb SET psumme=panzahl*ppreis*0.84 WHERE pid= ?");
          $sqlwarenkorbsumme->execute([$sPID]);
      }

    // Close connection
    $conn = null;
    
    
}catch(PDOException $e){
    echo $e;
}

header("Location: Warenkorb.php");

?>