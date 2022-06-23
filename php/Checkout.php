<?php
session_start();
  
//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$db = new PDO($dsn,$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$userid=$_SESSION['id'];
$userwaren ="SELECT * FROM bestellung WHERE userid=$userid";

$result = $db->query($userwaren);

 //Artikelsumme im Bestellkorb
$amount="SELECT SUM(summe) FROM bestellung WHERE userid=$userid";

 foreach($db->query($amount) as $row)
       {
           $sSumme=$row['SUM(summe)'];
       }

$amount2="SELECT SUM(menge) FROM bestellung WHERE userid=$userid";

foreach($db->query($amount2) as $row)
{
    $sZahl=$row['SUM(menge)'];
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

    <title>Kasse</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
<link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
              <img class="d-block mx-auto mb-4" src="../img/logo.png" alt="" width="200" height="100">
              <h2>Kasse</h2>
              <p class="lead">CHECKOUT</p>
   </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Dein Warenkorb</span>
          <span class="badge bg-primary rounded-pill"><?php echo $sZahl; ?></span>
        </h4>
        <ul class="list-group mb-3">

<?php while($row = $result->fetch()):?>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?php echo $row['titel']?></h6>
              <small class="text-muted"><p></p></small>
            </div>
            <span class="text-muted"><?php echo sprintf("%01.2f", $row['summe'])?>€</span>
          </li>
<?php endwhile;?>

          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">RABATTCODE</h6>
              <small><p></p></small>
            </div>
            <span class="text-success">
                <?php 
                $rabatte ="SELECT rabatt FROM bestellung WHERE userid=$userid";
                foreach($db->query($rabatte) as $row)
                {
                    $sRabatt=$row['rabatt'];
                }
                if (empty($sRabatt)) {
                    echo"Kein Rabatt angewendet";
                } else {
                    for ($x = 0; $x < 1; $x++  )
                {
                
                 echo (1-$row['rabatt'])*100;
                }
                }
                
                
            ?>%
            </span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>SUMME €</span>
            <strong><?php echo sprintf("%01.2f", $sSumme)?></strong>
          </li>
        </ul>

        <form class="card p-2" action="gutscheincodeVerwenden.php" method="post">
          <div class="input-group">
            <input type="text" name="code" class="form-control" placeholder="Code">
            <button type="submit" class="btn btn-secondary">einlösen</button>
          </div>
        </form>
      </div>



      <div class="col-md-7 col-lg-8">

   <form method="post" action="bestellungAbschließen.php">   

        <h4 class="mb-3">Rechnungsadresse</h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Vorname</label>
              <input name="vorname" type="text" class="form-control" id="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Bitte geben Sie Ihren Vornamen ein
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Nachname</label>
              <input name="nachname" type="text" class="form-control" id="lastName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Bitte geben Sie Ihren Nachnamen ein
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">E-mail</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input name="email" type="email" class="form-control" id="email" placeholder="email" required>
              <div class="invalid-feedback">
                  Bitte E-Mail eingeben
                </div>
              </div>
            </div>

          <!--<div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div> -->

            <div class="col-12">
              <label for="address" class="form-label">Straße, Hausnummer</label>
              <input name="straße" type="text" class="form-control" id="address" placeholder="Musterstraße 12" required>
              <div class="invalid-feedback">
                Bitte Straße und Hausnummer eingeben
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Adressenzusatz <span class="text-muted">(Optional)</span></label>
              <input name="zusatz" type="text" class="form-control" id="address2" placeholder="Gebäude/Stock">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Land</label>
              <select name="land" class="form-select" id="country" required>
                <option value="">Auswählen</option>
                <option>Deutschland</option>
                <option>Österreich</option>
                <option>Schweiz</option>
              </select>
              <div class="invalid-feedback">
              Bitte Land auswählen
              </div>
            </div>

            <div class="col-md-4">
           <label for="Stadt" class="form-label">Ort</label>
              <input name="ort" type="text" class="form-control" id="ort" placeholder="" required>
              <div class="invalid-feedback">
               -- Bitte Ort angeben
              </div>
          </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Postleitzahl</label>
              <input name="plz" type="text" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Bitte PLZ eingebn
              </div>
            </div>
          </div>
          <br>
          <!-- <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address">
            <label class="form-check-label" for="same-address">Liefer und Rechnungsadresse sind identisch</label>
          </div> -->

          <hr class="my-4">

          <h4 class="mb-3">Versandart</h4>

          <!-- Versandart auswählen -->
          <!-- <div class="col-4">
            <form action="versand.php" method="POST">
            <input class="" name="dpd" type="radio" id="dpd" name="versandarten" value="24" required/>
            <label for="dpd"><br><img src="../img/DPD.jpg" class=img-thumbnail height=100 width=100>24€</label><br>
        
            <input type="radio" name="dhl" id="dhl" name="versandarten" value="24" required/>
            <label for="dhl"><br><img src="../img/DHL.jpg" class=img-thumbnail height=100 width=100>24€</label><br>

            <input type="radio" name="dhlexpress" id="dhlExpress" name="versandarten" value="33" required/>
            <label for="dhlExpress"><br><img src="../img/DHLE.jpg" class=img-thumbnail height=100 width=100>33€</label><br>
            </form> 
          </div> -->

          <hr class="my-4">

          <h4 class="mb-3">Zahlungart</h4>

          <div class="my-3">
            <div class="form-check">
            <?php $credit ?>  <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">KreditKarte</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div>
    

          

        <?php 
         //if($credit)
        
         
        ?>
          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>
          
       
            
            <div class="col-md-6">
              <label for="cc-number" class="form-label">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>

          <hr class="my-4">
          <div class="form-check">
<<<<<<< HEAD
            <input name="AGB" type="checkbox" class="form-check-input" id="save-info">
            <label  class="form-check-label" for="save-info" required>Datenschutzerklärung bestätigen</label>
=======
            <input id="datenschutz" name="datenschutz" type="checkbox" class="form-check-input" id="save-info" required>
            

          <?php 
          /* if(!isset($_POST['datenschutz']))
            {
            echo'Gehen Sie <a href="checkout.php"> zurück</a> und akzeptieren Sie die AGB';
            exit();
            }*/
            ?>

            <label class="form-check-label" for="save-info">Datenschutzerklärung bestätigen</label>
>>>>>>> 1649c624cfcba5480df4f190826de8f55123873a
          </div>
          <br>
          <button class="w-100 btn btn-primary btn-lg" type="submit">Bestellung bezahlen und bestätigen</button>
        </form>
      </div>
     </form> 
    </div>

  </main>


  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017–2021 huqqah</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <script src="form-validation.js"></script>
  </body>
</html>