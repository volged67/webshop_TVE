<?php


//Include required phpmailer files 
    require 'includes/PHPMailer.php';
    require 'includes/SMTP.php';
    require 'includes/Exception.php';
//Define name spaces 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

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

$mailFrom="From: huqqah";

//Create instance of phpmailer
    $mail = new PHPMailer();
//Set mailer to use smtp
    $mail->isSMTP();
//define smtp host
    $mail->Host = "smtp.gmail.com";
//enable smtp authentication
    $mail->SMTPAuth = "true";
//set type of encryption (ssl/tls)
    $mail->SMTPSecure = "tls";
//set port to connect smtp
    $mail->Port = "587";
//set gmail username
    $mail->Username = "volkan.gedik6798@gmail.com";
//set gmail password
    $mail->Password = "hhdlvffbtljlaprg";
//set email subject
    $mail->Subject = "Ihr neues huqqah Passwort!";
//set sender email
    $mail->setFrom("volkan.gedik6798@gmail.com");
//email body
function randomPW(){
    $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shfl = str_shuffle($comb);
    $pwd = substr($shfl,0,8);
    return $pwd;

}
    $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shfl = str_shuffle($comb);
    $pwd = substr($shfl,0,8);
    $mail->Body = "Ihr Passwort: $pwd";
//Add recipient
    $mail->addAddress($sEmail);
//Finally send email
   
    if ($mail->Send() ) {
        echo "Schauen sie in Ihre E-Mails!";
    }
    else {
        echo "Da hat etwas leider nicht geklappt!";
    }
//Closing smtp connection
    $mail->smtpClose();

    try
    {
      
     // ------DB Einstellungen-------
        //DB
        include 'php/zugangsdaten.php';
        //verbindung zur datenbank
        $conn = new PDO("mysql:host=$servername;dbname=$datenbankname", $benutzername, $benutzerpassword);
        //set the PDo error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        
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