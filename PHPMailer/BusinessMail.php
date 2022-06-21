<?php



//Include required phpmailer files 
    require 'includes/PHPMailer.php';
    require 'includes/SMTP.php';
    require 'includes/Exception.php';
//Define name spaces 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


$mailBetreff="Passwort zurücksetzen!";
$mailText="Hallo"; 

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
//Damit Umlaute funktionieren
    $mail->CharSet ="UTF-8";
    //Enable HTML
    $mail->isHTML(true);
//LOGO
    $mail->addEmbeddedImage('../img/logo.png','logo');
//email body 
    $mail->Body ="  <html>
                        <body>
                           <p><img src=\"cid:logo\"></p>
                            <p>Dein Passwort kannst du über diesen Link zurücksetzen http://localhost/webshop_TVE/php/passwortNeu.php</p>
                            <br/>
                            <p>Ihr Huqqah Team</p>
                        </body>
                     </html>";
    
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