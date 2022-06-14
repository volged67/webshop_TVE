<?php

session_start();
// Check ob man schon eingeloggt ist
if($_SESSION['login']!=111)
{
    header("Location: login.php");
}
// Variablen vordefinieren als Platzhalter
$sFirstname="";
$sLastname="";
$sStreet="";
$sHousenumber="";
$sPLZ="";
$sCity="";
$sMail="";
$bFirstlogin=true;
//$iSessionuserId=$_SESSION['id'];
//Formularwerte in Variablen speichern
if(isset($_POST['firstname']))
{
    $sFirstname=$_POST['firstname'];
}
if(isset($_POST['lastname']))
{
    $sLastname=$_POST['lastname'];
} 
if(isset($_POST['street']))
{
    $sStreet=$_POST['street'];
}
if(isset($_POST['plz']))
{
    $sPLZ=$_POST['plz'];
} 
if(isset($_POST['city']))
{
    $sCity=$_POST['city'];
}
if(isset($_POST['email']))
{
    $sMail=$_POST['email'];
}

if( empty($_POST['firstname']) OR empty($_POST['lastname']) OR empty($_POST['email']) OR empty($_POST['street']) OR empty($_POST['plz']) OR empty($_POST['city']) ) {
    header("Location: registrieren.php");
    echo "Nicht alle Felder ausgefüllt!";
}
else {
    //Passwort generieren und hashen
include "password.php";
$genPassword=passGenerator(9);
//$sPassword=password_hash($genPassword,CRYPT_SHA512);
//$sPassword = hash('sha512', $genPassword);
//$_SESSION['OldPassword']=$sPassword;
$sPassword = hash('sha512',$genPassword);





// PHP-Mailer
include "../PHPMailer/index.php";

try
{
//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 // Existiert die email bereits?
 $query=$conn->prepare("SELECT * FROM register_user WHERE email= ?");
 $query->execute([$sMail]);
 $result = $query->rowCount();
 if($result >0){
     $error = "Email already exists";
     header("Location: registrieren.php");
     echo  "Email already exists";
 }
  else 
  {
    $sql = "INSERT INTO register_user (regid,firstname,lastname,street,plz,city,email,password,firstlogin) VALUES (?,?,?,?,?,?,?,?,?)";
     $stmt=$conn->prepare($sql);
     $stmt->execute([$iSessionuserId,$sFirstname,$sLastname,$sStreet,$sPLZ,$sCity,$sMail,$sPassword,$bFirstlogin]);
     header("Location: firstlogin.php");
  }
  

    

     //Verbindung schließen
     $conn=null;
}
catch(Exception $e)
{
    echo "Fehler";
}

}




?>