<?php
session_start();

error_reporting(-1);
ini_set('display_errors','On');

//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$db = new PDO($dsn,$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*
 $userid=$_SESSION['id'];
 $bestellung ="SELECT * FROM warenkorb WHERE userid=$userid"; 
 //$bestellung ="SELECT * FROM warenkorb WHERE userid=$userid AND wid=$wid"; 
 $result = $db->query($bestellung); 

*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bestellung</title>
     <!-- Bootstrap -->
     <meta charset="utf-8">
    <title>Kasse</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
              <!-- Navigationsleiste -->
              <?php
             // include 'navbar.php';
              ?>
          <body class="bg-light">
            
        <div class="container">
          <main>
            <div class="py-5 text-center">
              <img class="d-block mx-auto mb-4" src="../img/logo.png" alt="" width="200" height="100">
              <h2>Bestellung</h2>
              <p class="lead">Bestellung nochmal prüfen.</p>
            </div>

            <div class="row g-5">
              <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-primary">Dein Einkauf</span>
                  <span class="badge bg-primary rounded-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                  <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                      <h6 class="my-0">Produkt Name</h6>
                     <!-- <small class="text-muted">Brief description</small> -->
                    </div>
                    <span class="text-muted">€</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                      <h6 class="my-0">Produkt name</h6>
                      
                    </div>
                    <span class="text-muted">€</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                      <h6 class="my-0">Versandart</h6>
                      <small class="text-muted"></small>
                    </div>
                    <span class="text-muted"></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                      <h6 class="my-0">Rabattcode</h6>
                     
                    </div>
                    <span class="text-success">%</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between">
                    <span>Summe €</span>
                    <strong>€</strong>
                  </li>
                </ul>

                <form class="card p-2">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rabattcode">
                    <button type="submit" class="btn btn-secondary">hinzufügen</button>
                  </div>
                </form>
              </div>
              <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Rechnungsadresse</h4>
                <form class="needs-validation" novalidate>
                  <div class="row g-3">
                    <div class="col-sm-6">
                     <!-- <label for="firstName" class="form-label">Vorname</label>
                      <input type="text" class="form-control" id="firstName" placeholder="Max" value="" required>
                      <div class="invalid-feedback">
                      Vorname ist erforderlich! 
                      </div>-->
                    </div>

                    <div class="col-sm-6">
                     <!-- <label for="lastName" class="form-label">Nachname</label>
                      <input type="text" class="form-control" id="lastName" placeholder="Mustermann" value="" required>
                      <div class="invalid-feedback">
                        Nachname ist erforderlich! 
                      </div
                    </div>
                      -->
                    <div class="col-12">
                    
                      <label for="email" class="text-info">Benutzername</label><br>
                      <div class="input-group has-validation">
                        <span class="input-group-text">@</span>
                        <input type="email" name="username" id="username" class="form-control" placeholder="maxmustermann@google.com" required>
                      <div class="invalid-feedback">
                          Bitte geben sie Ihr Benutzername ein
                        </div>
                      </div>
                    </div>

                    <hr class="my-4">
                  <!--
                    <div class="col-12">
                     <!-- <label for="address" class="form-label">Adresse</label>
                      <input type="text" class="form-control" id="address" placeholder="Reutlinger Straße 13" required>
                      <div class="invalid-feedback">
                        Bitte geben Sie Ihre Adresse ein (Straße, Hausnummer)
                      </div> -->
                    </div>

                    <div class="col-12">
                     <!-- <label for="address2" class="form-label">Addresszusatz<span class="text-muted">(Optional)</span></label>
                      <input type="text" class="form-control" id="address2" placeholder=""> -->
                    </div>

                    

                    <div class="col-md-3">
                      <!-- <label for="state" class="form-label">Ort</label>
                      <input type="text" class="form-control" id="zip" placeholder="Gäufelden" required>
                      
                      </select>
                      <div class="invalid-feedback">
                      Bitte geben sie Ihr Ort an
                      </div> -->
                    </div>

                    <div class="col-md-3">
                     <!-- <label for="zip" class="form-label">Postleitzahl</label>
                      <input type="text" class="form-control" id="zip" placeholder="71126" required>
                      <div class="invalid-feedback">
                      Bitte PLZ eingeben
                      </div>-->
                    </div> 
                  </div>
                     
                  <br>
                  <div class="col-md-5">
                      <label for="country" class="form-label">Versand</label>
                      <select class="form-select" id="country" required>
                        <option value="">Versandart wählen</option>
                        <option>DPD</option>
                        <option>DHL Aufpreis von 9€ auf DPD</option>
                        <option>DHL Express von 33€ auf DPD</option>
                      </select>
                      <div class="invalid-feedback">
                        Bitte Versandart wählen.
                      </div>
                    </div>


                 
                  <br>

                  <h4 class="mb-3">Zahlungsart</h4>

                  <div class="my-3">
                    <div class="form-check">
                      <input id="credit" name="credit" type="radio" method="post" class="form-check-input" checked required>
                      <label class="form-check-label" for="credit">Kredit Karte</label>
                    </div>
                    <!--<div class="form-check">
                      <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                      <label class="form-check-label" for="debit"></label>
                    </div> -->
                    <div class="form-check">
                      <input id="paypal" name="paypal" type="radio" class="form-check-input" required>
                      <label class="form-check-label" for="paypal">PayPal</label>
                    </div>
                  </div>

                  <?php
                  if(isset($_POST['credit']))
                  {
                    
                      

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
                      <?php

                  }

                      ?>
                    


                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="same-address">
                  <label class="form-check-label" for="same-address">Datenschutz einwilligen </label>
                </div>

                <hr class="my-4">

                  <button class="w-100 btn btn-primary btn-lg" type="submit">Jetzt Bezahlen und Bestellen</button>
                </form>
              </div>
            </div>
          </main>

          <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017–2021 Company Name</p>
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
