<?php
session_start();

//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
$db = new PDO($dsn,$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$userid=$_SESSION['id'];
$userwaren ="SELECT * FROM bestellt WHERE userid=$userid";

$result = $db->query($userwaren);

 //Artikelsumme im Warenkorb
 $amount="SELECT SUM(summe) FROM bestellt WHERE userid=$userid";

 foreach($db->query($amount) as $row)
       {
           $sSumme=$row['SUM(summe)'];
       }



?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Warenkorb</title>
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     
     <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
</head>
<body>
    <!-- Tabelle mit Artikeln die bestellt wurden -->

    <section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Bestellung Nr: <?php $bestellnr ="SELECT bestellnr FROM bestellt WHERE userid=$userid";
                foreach($db->query($bestellnr) as $row)
                {
                    $sRabatt=$row['bestellnr'];
                }
                for ($x = 0; $x < 1; $x++  )
                {
                 echo $row['bestellnr'];
                } ?></h3>
        </div>

        <?php while($row = $result->fetch()):?>
          <div class="row">
          
          

            <div class="col">
              <?php
                //Artikel einfügen
                
                echo "
                
                <div class='card rounded-3 mb-4'>
                        <div class='card-body p-4'>
                          <div class='row d-flex justify-content-between align-items-center'>
                            <div class='col-md-2 col-lg-2 col-xl-2'>
                              <img src='../img/".$row['bildlink']."'
                              class='img-fluid rounded-3' alt='Cotton T-shirt'>
                            </div>
                            <div class='col-md-3 col-lg-3 col-xl-3'>
                              <p class='lead fw-normal mb-2'>".$row['titel']."</p>
                              <p><span class='text-muted'>Preis: </span>".$row['preis']."</p>
                            </div>

                            <div class='col-md-3 col-lg-3 col-xl-3'>
                              <p class='lead fw-normal mb-2'>Anzahl: </p>
                              <p><span class='text-muted'></span>".$row['menge']."</p>
                            </div>

                            <div class='col-md-3 col-lg-2 col-xl-2 offset-lg-1'>
                              <h5 class='mb-0'>Summe:<br>".sprintf("%01.2f", $row['summe'])."</h5>
                            
                          </div>
                        </div>
        </div>
      
        ";
        
        

              ?>
            </div>

        

        </div>
        <?php endwhile;?>

        <div class="card">
          <div class="card-body">
            <label for="password" class="text-info">Gesamtsumme:</label><br>
            <label for="gesamtsumme" class="text-info"><?php echo 
            sprintf("%01.2f", $sSumme);
            ?> </label><br>
          </div>
        </div>
        <br>

        <form action="bestellungWiederholen.php" method = "post">
        <div class="card">
          <div class="card-body">
            <button type="submit" class="btn btn-warning btn-block btn-lg">Nochmal bestellen</button>
          </div>
        </div>
        </form>

      </div>
    </div>
  </div>

</section>

</body>
</html>