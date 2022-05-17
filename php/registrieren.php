//PHP Verbindung erstellen

<?php 
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>huqqah-Registrieren</title>
    <!--Verlinkungen-->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }     
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }    
    }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO users (email, passwort) VALUES (:email, :passwort)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash));
        
        if($result) {        
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}
 
if($showFormular) {
?>
    

    <div id="login">
        <h3 class="text-center text-white pt-5">Registrieren</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Registrieren</h3>

                            <form action="?register=1" method="post">
                                
                            <div class="form-group">
                                <input type="radio" name="geschlecht" value="Mann">Mann<br>
                                <input type="radio" name="geschlecht" value="Frau">Frau<br>
                            </div>  

                            <div class="form-group">
                                <label for="name" class="text-info">Passwort:</label><br>
                                <input type="password" name="name" id="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name" class="text-info">Passwort wiederholen:</label><br>
                                <input type="password" name="name" id="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-info">E-Mail</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary"  type="submit" class="btn btn-primary" value="Abschicken">
                            </div>  
                            
                            

                              
                            <div id="login-link" class="text-right">
                                <a href="../php/login.php" class="text-info">zum Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body>
</html>