<?php

    session_start();

    $sNeuesPasswort="";
    $sNeuesPasswortWiederholen="";
    $sPasswortHash="";

    if(isset($_POST['neuespasswort']))
    {
        $sNeuesPasswort=$_POST['neuespasswort'];
    }
    if(isset($_POST['neuespasswortwiederholen']))
    {
        $sNeuesPasswortWiederholen=$_POST['neuespasswortwiederholen'];
    }
    if(isset($_POST['email']))
    {
        $sEmail=$_POST['email'];
    }

if($sNeuesPasswort==$sNeuesPasswortWiederholen){
    $sPasswortHash = hash('sha512',$sNeuesPasswort);
    try
    {
        //DB Settings
  include 'dbsettings.php';

  //Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //SQL
        $sql ="UPDATE user SET password=?   WHERE email=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$sPasswortHash,$sEmail]);
        
        $conn = null;
    }
    catch(PDOException $e)
    {
        $handle = fopen ("error_updatePasswort.txt", "w");
        fwrite ($handle, $e->getMessage());
        fclose ($handle);
    }
    header("Location: login.php");
}else{
echo "Passwörter stimmen nicht überein";
}

?>