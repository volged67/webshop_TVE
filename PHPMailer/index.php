<?php


//Include required phpmailer files 
    require 'includes/PHPMailer.php';
    require 'includes/SMTP.php';
    require 'includes/Exception.php';
//Define name spaces 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


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
    $mail->Subject = "Ihr huqqah Passwort!";
//set sender email
    $mail->setFrom("volkan.gedik6798@gmail.com");
//email body
    $mail->Body = "Hallo $sFirstname $sLastname, dein Passwort ist: $genPassword";
//Add recipient
    $mail->addAddress($sMail);
//Finally send email
   
    if ($mail->Send() ) {
        echo "Schauen sie in Ihre E-Mails!";
    }
    else {
        echo "Da hat etwas leider nicht geklappt!";
    }
//Closing smtp connection
    $mail->smtpClose();

    
?>