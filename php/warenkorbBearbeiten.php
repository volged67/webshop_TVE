<?php
session_start();

try
{
//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$db = new PDO($dsn,$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    //SQL
    // $sqlUpdateWarenkorb ="UPDATE warenkorb SET panzahl=?  WHERE wid=?";
    // $stmt=$conn->prepare($sqlUpdateWarenkorb);
    // $stmt->execute([$row['panzahl'],$row['wid']]);
    $userid=$_SESSION['id'];
    $userwaren ="SELECT wid FROM warenkorb WHERE pid='"$row['wid']"'";
    
    echo $userwaren;

    $result=$db->prepare("SELECT panzahl as AnzahlWarenkorb FROM warenkorb WHERE wid=$sAbfrage");
    $result->execute();
    $ergebnis = $result->fetchAll(); 
    
    foreach($ergebnis as $zeile){
        $onlineUser=$zeile["AnzahlWarenkorb"];
    }
    echo(int)$onlineUser . " sind im Warenkorb";
    $db = null;
}
    catch(PDOException $e)
    {
        $handle = fopen ("error_login.txt", "w");
        fwrite ($handle, $e->getMessage());
        fclose ($handle);
    }

    
?>