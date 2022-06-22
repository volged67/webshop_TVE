<?php

session_start();
// Check ob man schon eingeloggt ist
if($_SESSION['login']!=111)
{
header("Location: login.php");
}

// Suche der Artikel
if (isset($_POST['artikelsuche']))
{
    $sArtikel=$_POST['artikelsuche'];
    
}

//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$conn = new PDO($dsn,$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$wasserpfeife ="SELECT * FROM produkte WHERE produktart='Wasserpfeife' AND titel LIKE '%$sArtikel%'";

$result = $conn->query($wasserpfeife);

$phunnel= "SELECT * FROM produkte WHERE produktart='Phunnel' AND titel LIKE '%$sArtikel%'";

$result2 = $conn->query($phunnel);

$smokebox= "SELECT * FROM produkte WHERE produktart='Smokebox' AND titel LIKE '%$sArtikel%'";

$result3 = $conn->query($smokebox);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Suche</title>
</head>


<body>
  <?php
    include 'navbar.php';

    ?>



<!-- Tabelle mit Grid -->
      <hr>
  
      <h3>Wasserpfeifen</h3>
  
      <hr>
      <div class="row">
        <?php while($row = $result->fetch()):?>
          <div class="col">
            <?php
              include 'card.php';
            ?>
          </div>
        <?php endwhile;?>
      </div>
      <hr>
  
      <h3>Phunnel</h3>
  
      <hr>
      <div class="row">
        <?php while($row = $result2->fetch()):?>
          <div class="col">
            <?php
              include 'card.php';
            ?>
          </div>
        <?php endwhile;?>
      </div>
      <hr>
  
      <h3>Smokeboxen</h3>
  
      <hr>
      <div class="row">
        <?php while($row = $result3->fetch()):?>
          <div class="col">
            <?php
              include 'card.php';
            ?>
          </div>
        <?php endwhile;?>
      </div>
    
    

    



  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>