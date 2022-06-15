<?php
session_start();

error_reporting(-1);
ini_set('display_errors','On');

//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$db = new PDO($dsn,$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $userid=$_SESSION['id'];
 $bestellung ="SELECT * FROM warenkorb WHERE userid=$userid"; 
 //$bestellung ="SELECT * FROM warenkorb WHERE userid=$userid AND wid=$wid"; 
 $result = $db->query($bestellung); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bestellung</title>
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navigationsleiste -->
    <?php
    include 'navbar.php';
    ?>
    <html>
        <p>Hallo <?php  $sFirstname /*$sLastname*/ ?> </p>
        <p> Ihre Bestellungnummer lautet: <?php //$wid ?> </p>
        <b>Bestellübersicht</b>

        <table class="table table-striped">
        <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Artikelnummer</th>
      <th scope="col">Bezeichnung</th>
      <th scope="col">Anzahl</th>
      <th scope="col">Preis</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>121</td>
      <td>phunnel</td>
      <td>1</td>
      <td>25,99€</td>
    </tr>
  
  </tbody>

        </table>

    </html>
    
</body>
</html>