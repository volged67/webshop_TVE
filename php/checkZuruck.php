<?php

session_start();
// Check ob man schon eingeloggt ist
// if($_SESSION['login']!=111)
// {
//     header("Location: Index.php");
// }

// Variablen vordefinieren als Platzhalter
$sMail="";
$sPassword="";
// $iSessionuserId=$_SESSION['id'];


//Formularwerte in Variablen speichern

if($_POST['email'])
{
    $sMail=$_POST['email'];
}

//Passwort generieren und hashen
include "Password.php";

$genPassword=passGenerator(9);
// $sPassword=password_hash($genPassword,CRYPT_SHA512);
// $sPassword = password_hash(hash('sha512', $genPassword), PASSWORD_DEFAULT);

$sPassword=hash('sha512',$genPassword);


// PHP-Mailer
include "..\PHPMailer\zuruck.php";

try
{
    //DB Settings
  include 'dbsettings.php';

  //Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $sql="UPDATE user SET password='.$sPassword.' WHERE email ='.$sMail.'";
     $stmt=$conn->prepare($sql);
     $stmt->execute([$sMail,$sPassword]);


     //Verbindung schließen
     $conn=null;
}
catch(Exception $e)
{
    echo "Fehler";
}

//Verweis auf ne andere Seite einbauen
header("Location: passwortNeu.php");


?>