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
        $sql="SELECT*FROM register_user WHERE email='".$sMail."'AND password='".$sOldPassword."'";
        
    

        foreach($conn->query($sql) as $row)
        {
            $sUserID=$row['regid'];
            $sFirstname=$row['firstname'];
            $sLastname=$row['lastname'];
            $sStreet=$row['street'];
            $sPLZ=$row['plz'];
            $sCity=$row['city'];
        }

        $sHashPassword=password_hash($sNewPassword,CRYPT_SHA512);
        $sql2 = "INSERT INTO user (firstname,lastname,street,plz,city,email,password) VALUES (?,?,?,?,?,?,?)";
        $stmt=$conn->prepare($sql2);
        $stmt->execute([$sFirstname,$sLastname,$sStreet,$sPLZ,$sCity,$sMail,$sHashPassword]);
}



?>