<?php

session_start();

$sMail="";
$sOldPassword="";
$sNewPassword="";

if(isset($_POST['email']))
    {
        $sMail=htmlspecialchars($_POST['email']);
    }
    if(isset($_POST['oldpassword']))
    {
        $sOldPassword=htmlspecialchars($_POST['oldpassword']);
    }

    if(isset($_POST['newpassword']))
    {
        $sNewPassword=htmlspecialchars($_POST['newpassword']);
    }

    if ($sMail!=="" && $sOldPassword!=="" && $sNewPassword!=="")
    {
        //DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    

//$sql="SELECT*FROM register_user WHERE email='".$sMail."'AND password='".password_hash($sOldPassword,CRYPT_SHA512)."'";
        //$sql="SELECT*FROM register_user WHERE email='".$sMail."'AND password='".$sOldPassword."'";
        
        $sql="SELECT*FROM register_user WHERE email='".$sMail."'AND password='".hash('sha512',$sOldPassword)."'";

    
//Daten aus der Tabelle rausziehen
        foreach($conn->query($sql) as $row)
        {
            $sUserID=$row['regid'];
            $sFirstname=$row['firstname'];
            $sLastname=$row['lastname'];
            $sStreet=$row['street'];
            $sPLZ=$row['plz'];
            $sCity=$row['city'];
            $bFirstLoginSuccess=true;
        }

//Gehashtes Passwort wird übergeben an die user Tabelle!
        $sHashPassword=hash('sha512',$sNewPassword);
        $sql2 = "INSERT INTO user (firstname,lastname,street,plz,city,email,password) VALUES (?,?,?,?,?,?,?)";
        $stmt=$conn->prepare($sql2);
        $stmt->execute([$sFirstname,$sLastname,$sStreet,$sPLZ,$sCity,$sMail,$sHashPassword]);

//Weiterleitung je nach erfolgreichem Success
        if($bFirstLoginSuccess=true)
        {
            header("Location: login.php");
        }
        else
        {
            header("Location: firstlogin.php");
        }
}



?>