
  <?php
  
  error_reporting(-1);
  ini_set('display_errors','On');
  
  //DB Settings
  include 'dbsettings.php';
  
  //Verbindung zur Datenbank
  $db = new PDO($dsn,$username,$password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  //Summe der Artikel im Warenkorb
  $userid=$_SESSION['id'];
  $amount="SELECT SUM(panzahl) FROM warenkorb WHERE userid=$userid";

  foreach($db->query($amount) as $row)
        {
            $sZahl=$row['SUM(panzahl)'];
        }
  
  ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- Wichtig für Fontawesome -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
    <!-- Navigationsleiste unvollständig -->

  
    
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  
    <a class="navbar-brand" href="../php/Startseite.php"><img src="../img/logo.png" class="img-responsive"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../php/Artikelseite.php">
            <button type="button" class="btn btn-outline-primary">Artikel</button>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../php/login.php">
            <button type="button" class="btn btn-outline-primary">Anmelden</button>
          </a>
        </li>
        <li class="nav-item">
          <?php
          //if ($_SESSION['login']=111) {
          //  include 'logoutbutton.php';
          //}
         // else {
         //   include 'loginbutton.php';
         // }
          ?>
        <li class="nav-item">
          <a class="nav-link" href="../php/logout.php">
            <button type="button" class="btn btn-outline-primary">Logout</button>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../php/registrieren.php">
            <button type="button" class="btn btn-outline-primary">Registrieren</button>
          </a>
        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../php/Warenkorb.php">
            <button type="button" class="btn btn-outline-primary position-absolute">
              Warenkorb
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo $sZahl; ?>
                <span class="visually-hidden">Warenkorb</span>
              </span>
            </button>
          </a>
        </li>
      </ul>
    </div>
<!--Artikelsuche-->

        <form class="form-inline ms-2 my-lg-0" method="POST" action="Suche.php">
          <input class="form-control ms-sm-2 " name="artikelsuche" type="input" placeholder="Suchen" aria-label="Search">
          <button  style='font-size:24px' class="btn btn-outline-light text-center ms-2 my-sm-0 fas fa-search" type="submit"></button>
        </form>

  </nav>
  
  <br>
</body>
</html>