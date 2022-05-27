<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

// Random PW mit Buchstaben und Zahlen erzeugen:
function randomPW(){

    $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shfl = str_shuffle($comb);
    $pwd = substr($shfl,0,8);
    return $pwd;

}
session_start();
$bLoginSuccsess=false;
$sVorname=$_POST['vorname'];
$snNachname=$_POST['nachname'];
$sEmail=$_POST['email'];
$sStrasse=$_POST['str'];
$sOrt=$_POST['ort'];
$sPlz=$_POST['plz'];
$sPasswort=randomPW();
$sPasswortHash = hash('sha512',$sPasswort);

$mailBetreff="Registrierungsmail";
$mailText="Hallo".$sVorname; 

//$mailFrom="From: Ö-Shop <test@DESKTOP-M10IQI3.de>";



$mail = new PHPMailer(true);
    // ------E-Mail Einstellungen--------
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'volkan.gedik6798@gmail.com';                     //SMTP username
    $mail->Password   = 'hhdlvffbtljlaprg';                               //SMTP password
    $mail->SMTPSecure = 'tls';                                  //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->Charset = "UTF-8";
    //Recipients
    $mail->setFrom('volkan.gedik6798@gmail.com', 'huqqah');       // Absender
        
    $mail->addAddress($sEmail);               //Ziel Adresse
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Registrierung';
    $mail->Body    = 'Hallo <b>'.$sVorname.'</b>,<br> dein Passwort lautet: '.$sPasswort.' . Bitte lege ein neues Passwort fest.<br> Viele Grüße <br> dein huqqah Team' ;
    
    try
{
  
 // ------DB Einstellungen-------
    //DB
    include 'connection.php';
    //verbindung zur datenbank
    //$conn = new PDO("mysql:host=$servername;dbname=$datenbankname", $benutzername, $benutzerpassword);
    //set the PDo error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    //SQL
    $sqlNeuerBenutzer = "INSERT INTO wslogin (vorname,nachname,passwort,email,straße,ort,plz)
    VALUES(?,?,?,?,?,?,?)";
    // $bLoginSuccsess=true;
    $stmt=$conn->prepare($sqlNeuerBenutzer);
    $stmt->execute([$sVorname,$snNachname,$sPasswortHash,$sEmail,$sStrasse,$sOrt,$sPlz]);

    //close connection
    $conn = null;
    $bLoginSuccsess=true;
    
    if($mail->send()){

        
        // header( "refresh:0;url=login.html" ); 
        header('Location: login.html');
    }else{
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    
    
    
    
}
catch(PDOException $e)
{
    $bLoginSuccsess=false;
     echo( ausgabe($e->getMessage()));
     header( "refresh:3;url=registrierung.php" );
    /*
    echo"<script type=text/javascript>
    alert(".( ausgabe($e->getMessage())).")
    </script>";
    */
    //$handle = fopen ("error_login.txt", "w");
    // fwrite ($handle, $e->getMessage());
    // fclose ($handle);
    // $bLoginSuccsess=false;
    // echo("REGISTRIERUNG FEHLGESCHLAGEN: ". $e ->getMessage());
    

}

function ausgabe($datenZumAusgeben){
    $AusgabenListe="
    <h5>Registrierung fehlgeschlagen:</h5> <br>";
    
    $AusgabenListe.=$datenZumAusgeben;
    return $AusgabenListe;
}

/*
if ($bLoginSuccsess)
{
    //Weiterleiten
     header("Location: ../php/übersicht.php");
   // echo "test 1";
   
}
else{
    header("Location: ../login.html");
   //echo "test 2";
}
*/
?>