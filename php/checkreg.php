<?php

session_start();

// Variablen vordefinieren als Platzhalter
$sFirstname="";
$sLastname="";
$sStreet="";
$sHousenumber="";
$sPLZ="";
$sCity="";
$sMail="";
$bFirstlogin=false;
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


//Passwort generieren und hashen
include "password.php";
$genPassword=passGenerator(9);
$sPassword = hash('sha512',$genPassword);




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
     echo  "Email existiert bereits!";
 }
else {
    $sql = "INSERT INTO register_user (regid,firstname,lastname,street,plz,city,email,password,firstlogin) VALUES (?,?,?,?,?,?,?,?,?)";
     $stmt=$conn->prepare($sql);
     $stmt->execute([$iSessionuserId,$sFirstname,$sLastname,$sStreet,$sPLZ,$sCity,$sMail,$sPassword,$bFirstlogin]);
     header("Location: firstlogin.php");
     // PHP-Mailer
    include "../PHPMailer/index.php";
  }
  

    

     //Verbindung schließen
     $conn=null;
}
catch(Exception $e)
{
    echo "Fehler";
}






?>