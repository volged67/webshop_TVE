<?php 

//echo "Hallo 1234";

session_start();

$sEmail="";
$sPasswort="";
$sPasswortHash="";
$bLoginSuccsess=false;
$sWidth="";
$sHeight="";

if (isset($_POST['username']))
{
    $sEmail=$_POST['username'];
}
if (isset($_POST['password']))
{
    $sPasswort=$_POST['password'];
}
if(isset($_POST['width']) && isset($_POST['height'])) {
    $sWidth = $_POST['width'];
    $sHeight = $_POST['height'];
}

$sPasswortHash=hash('sha512',$sPasswort);
try
{
    //DB Verbindung
    include 'connection.php';
    //set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //SQL
    $sql = "SELECT * FROM wslogin WHERE email='$sEmail' AND passwort='$sPasswortHash'";
    foreach ($con->query($sql) as $row)
    {
        
        $bLoginSuccsess=true;
        $_SESSION["vorname"] = $row["vorname"];
        $_SESSION["nachname"] = $row["nachname"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["login"] = 111;
        $_SESSION["zeit"] = time();
        $_SESSION["emailBestätigt"]=$row["emailBestätigt"];
        $_SESSION["eingelogt"]=$row["eingelogt"];
        $zeit="";
        $zeit=$_SESSION["zeit"];
       
    }
    // Hier if erste mal login dann pflicht zur pw änderung! danach zur übersicht.php
    if($bLoginSuccsess){
        if($_SESSION["emailBestätigt"]!="nein"){
            // Login Daten speichern in Tabelle userDaten
            $sqlLoginDaten = "INSERT INTO userdaten (bildschirm,betriebssystem,email)
            VALUES(?,?,?)";
            $stmt=$conn->prepare($sqlLoginDaten);
            $stmt->execute(["x",
            php_uname(),$sEmail]);
             header("Location: ../php/übersicht.php");
             $sqlUpdateEingeloggt="UPDATE wslogin SET eingelogt ='1' WHERE wslogin.email =?";
             $stmt2=$conn->prepare($sqlUpdateEingeloggt);
             $stmt2->execute([$sEmail]);
         
        }else{
            // Falls email noch nicht bestätigt wurde 
            header("Location: ../neuesPW.html");
            // PW Änderung pflicht!
            'alert("test")';
        }
    }else{
        // Falls $bLoginSuccsess falsch ist wieder auf login 
        header("Location: ../login.html");
    }
    //close connection
    $conn = null;
}
catch(PDOException $e)
{
    $handle = fopen ("error_login.txt", "w");
    fwrite ($handle, $e->getMessage());
    fclose ($handle);
    // echo("TEST");
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