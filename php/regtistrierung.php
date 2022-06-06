<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            Registrierung
        </title>
            <!--Verlinkungen-->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Bootstrap -->
        <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fontawesome -->
        <link href="node_modules/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">
        <script src="node_modules/jquery/jquery.js"></script>
        <script type="text/javascript">
        </script>
           
    </head>
    <body>
        

<?php 
//Navbar
include 'navbar.php';

//session_start();


//if(isset($_SESSION["eingelogt"])){
 //if($_SESSION["eingelogt"]=1){
   //echo "<a href=logout.php><i class=fas fa-sign-out-alt></i> Logout</a>  ";
 //}else{
   //echo "<a href=login.php><i class=fas fa-sign-out-alt></i> Login</a>  ";
 //}

//}else{
 //echo "<a href=login.php><i class=fas fa-sign-out-alt></i> Login</a>  ";
//}
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
   Ihr Passwort erhalten Sie per Mail!                                      
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