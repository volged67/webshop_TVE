<?php

session_start();
// Check ob man schon eingeloggt ist
if($_SESSION['login']!=111)
{
header("Location: Login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Search</title>
</head>


<body>
  <?php
    include 'navbar.php';

    ?>

<?php
// Suche der Artikel
if (isset($_POST['artikelsuche']))
{
    $sArtikel=$_POST['artikelsuche'];
    
}
try
{  
    //DB Settings
    include 'dbsettings.php';

    //Verbindung zur Datenbank
    $conn = new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
    
    //SQL
    $sqlSucheArtikel = ("SELECT * FROM produkte WHERE titel LIKE '%$sArtikel%'");
    $abfrage = $conn->prepare($sqlSucheArtikel);
    $abfrage->execute();
    $ergebnis = $abfrage->fetchAll();
    
    foreach($ergebnis as $zeile){
      



      echo "<tr>";
 
      echo "<td> Productname: ".$zeile["titel"]." <br><img src='../img/".$zeile['bildlink']."' class=img-thumbnail height=100 width=100></td>";
      echo "<td><br>Price: ".$zeile["preis"]."€<br>Quantity: </td>";
      echo "<td>".$zeile["menge"]."</td>";
      echo "<td>";
      echo"<br>
      <div class=text-center>
      
      <form class=text-center method=POST action=ablegenInWarenkorb.php?pid=" .$zeile["id"]." role=form>
                                 
      <input type=number min=1 class=form-control name=quantity placeholder=amount value=1 style=width: 100px>
      <button class=btn type=submit> Add to Card <i class='fas fa-shopping-cart'></i></button>

      </form>
      </div>
    </td>";

    }
    
    $conn = null;
    
}
    
catch(PDOException $e)
{
    $handle = fopen ("error_login.txt", "w");
    fwrite ($handle, $e->getMessage());
    fclose ($handle);
}
    
?>


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