<?php
try
{
//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$conn = new PDO($dsn,$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //SQL
    $result=$conn->prepare("SELECT COUNT(logedin) as UserOnline FROM user WHERE logedin =True");
    $result->execute();
    $ergebnis = $result->fetchAll(); 
    
    foreach($ergebnis as $zeile){
        $onlineUser=$zeile["UserOnline"];
    }
    echo(int)$onlineUser . " Benutzer online";
    $conn = null;
}
    catch(PDOException $e)
    {
        $handle = fopen ("error_login.txt", "w");
        fwrite ($handle, $e->getMessage());
        fclose ($handle);
    }

?>