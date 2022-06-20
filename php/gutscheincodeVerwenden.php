<?php
 session_start();

 $sUserId=$_SESSION['id'];

//Anzahl Gutscheincode Übergabe
$sCode="";
if(isset($_POST['code']))
    {
        $sCode=($_POST['code']);
    }


//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//SQL CODES Abrufen aus der Datenbank
$codes ="SELECT prozent FROM gutscheincodes WHERE code='$sCode'";

$result = $conn->query($codes);

//SQL abrufen ob Rabatt angewendet
$rabattiert="SELECT rabatt FROM bestellung WHERE userid=$sUserId";

$result2 = $conn->query($rabattiert);

//Datenfeld Result and Rabatt
$sResult="";
$sRabatt="";

foreach($conn->query($codes) as $row)
        {
            $sResult=$row['prozent'];
        }

foreach($conn->query($rabattiert) as $row)
        {
            $sRabatt=$row['rabatt'];
        }


//Code ist nicht vorhanden oder bereits verwendet
if (empty($result) OR $sRabatt!=0) {
    echo "Leider stimmt etwas nicht mit diesem Code oder dieser wurde schon angewendet!";
}
//Code ist verfügbar
else {
    //Rabatt aktualisieren bei Bestellung
    $sql2=$conn->prepare("UPDATE bestellung SET rabatt=$sResult WHERE userid= ?");
    $sql2->execute([$sUserId]);
    //Rabatt anwenden
    $sql=$conn->prepare("UPDATE bestellung SET summe=summe*$sResult WHERE userid= ?");
    $sql->execute([$sUserId]);
}

//Weiterleitung zur Artikelübersicht
header("Location: Checkout.php");

//Verbindung zur Datenbank beenden
$conn=null;


?>