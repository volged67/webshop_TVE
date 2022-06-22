<?php

//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$conn = new PDO($dsn,$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$userid=$_SESSION['id'];
$userwaren ="SELECT * FROM bestellt WHERE userid=$userid";

$result = $conn->query($userwaren);

// foreach($conn->query($userwaren) as $row)
//         {
//             $sPTitel=$row['titel'];
//             $sPPreis=$row['preis'];
//             $sPMenge=$row['menge'];
//         }



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
    $mail->Subject = "Ihre huqqah Bestellung";
//set sender email
    $mail->setFrom("volkan.gedik6798@gmail.com");
//Damit Umlaute funktionieren
    $mail->CharSet ="UTF-8";
//Enable HTML
    $mail->isHTML(true);
//LOGO
    $mail->addEmbeddedImage('../img/logo.png','logo');
//email body
$bodystring=""; 
    $bodystring ="  <html>
                        <body>
                           <p><img src=\"cid:logo\"></p>
                            <p>Vielen Dank für deine Bestellung!</p>
                            <br/>
                            <p>
                            <h3>Deine Bestellung:</h3>
  
                            ";
                            while($row = $result->fetch())
                            {
                                $bodystring=$bodystring.
                                "<li>
                                <div>
                                <p>".$row['titel']."</p>
                                    <small><p></p></small>
                                </div>
                                <span>".$row['preis']."€</span>
                                </li>";
                            }
                                
                            $bodystring=$bodystring." 
                            <hr>
                            </p>
                            <br>
                            <p>Ihr Huqqah Team</p>
                        </body>
                     </html>";
                     $mail->Body = $bodystring;
    
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

    
?>