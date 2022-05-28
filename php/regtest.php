<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            Registrierung
        </title>
        <!-- Bootstrap -->
        <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fontawesome -->
        <link href="node_modules/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">
        <script src="node_modules/jquery/jquery.js"></script>
        <script type="text/javascript">



        </script>
         <style>
            a { text-decoration: none; color: grey }
            .dropbtn {
        
        color: grey;
        padding: 16px;
        font-size: 16px;
        border: none;
        }
        
        .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        }
        
        .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        }
        
        .dropdown-content a:hover {background-color: #ddd;}
        
        .dropdown:hover .dropdown-content {display: block;}
        
        .dropdown:hover .dropbtn {background-color: LightGray;}
            </style>    
    </head>
    <body>
        <!-- NAV  -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="navbar.php">TVE</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="php/übersicht.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="php/warenkorb.php"><i class="fas fa-shopping-cart"></i>Warenkorb</a>
          </li>
          <li class="nav-item">
          <div class="dropdown">
    <button class="dropbtn" id="btnKategorie">Kategorie</button>
    <div class="dropdown-content">
    <a href="php/artikel.php?parameter=games">Games</a>
 <a href="php/artikel.php?parameter=filme">Filme</a>
 <a  href="php/artikel.php?parameter=computer">Computer</a>
 <a href="php/artikel.php?parameter=audio">Audio</a>
    </div>
  </div>
  </li>
          <li class="nav-item">
          <a class="nav-link" href="php/bisherigeBestellungen.php">Meine Bestellungen</a>
          </li>
        </ul>
        <form method="POST" action="php/suche.php" class="d-flex" id=warenkorbform class=form-horizontal role=form >
  <input class="form-control me-2" type="search" placeholder="Search" id="sucheArtikel" name="sucheArtikel" aria-label="Search">
  <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i>Suche </button>
</form>
<?php 
session_start();


if(isset($_SESSION["eingelogt"])){
 if($_SESSION["eingelogt"]=1){
   echo "<a href=logout.php><i class=fas fa-sign-out-alt></i> Logout</a>  ";
 }else{
   echo "<a href=login.php><i class=fas fa-sign-out-alt></i> Login</a>  ";
 }

}else{
 echo "<a href=login.php><i class=fas fa-sign-out-alt></i> Login</a>  ";
}
?>
        
        
        
        
      </div>
    </div>
  </nav>
        <!--Registrierung Form-->
<form method="POST" action="../PHPMailer/index.php" id="regForm" class="form-horizontal" role="form">
        <div class="container">
            <div class="row">

        </div>
        <div class="row">
            <h1>Konto erstellen</h1>
            Ihr Vorname 
            <div style="margin-bottom: 25px" class="input-group"> 
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="regVorname" type="text" name="vorname" value="" placeholder="" required>                                        
        </div>

        Ihr Nachname 
        <div style="margin-bottom: 25px" class="input-group"> 
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="regNachname" type="text" name="nachname" value="" placeholder="" required>                                        
    </div>
    E-Mail
    <div style="margin-bottom: 25px" class="input-group"> 
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="regEmail" type="mail" name="email" placeholder="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" minlength="4" required>   
    
    
    
    </div>
    <div id="pruefeEmail">
        <p id="pruefeEmail"></p>
    </div>
    <br>
    Straße
<div style="margin-bottom: 25px" class="input-group"> 
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input id="regStrasse" type="text" name="str" value="" placeholder="" required>
</div>
Ort
<div style="margin-bottom: 25px" class="input-group"> 
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input id="regOrt" type="text" name="ort" value="" placeholder="" required>
</div>
PLZ
<div style="margin-bottom: 25px" class="input-group"> 
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input id="regPlz" type="text" name="plz" value="" placeholder="" required>
</div>
    Passwort erhalten Sie per Mail!                                       
    <p></p>
    <div class="col-sm-12 controls">
        <button type="submit" class="btn btn-success" id="regBtn">Erstellen Sie Ihr Konto</button>
        </div>
        

        
    </div>      
</div>
</form>


<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
   


<script>
    $(document).ready(function() {
        $("#pruefeEmail").load("php/pruefeEmail.php");
            var refreshId = setInterval(function() {
                $("#pruefeEmail").load("php/pruefeEmail.php");
            }, 10000);
    });
    </script>

<script src="node_modules/jquery/jquery.js"></script>
</body>
</html>