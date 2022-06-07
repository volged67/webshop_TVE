<?php

//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Prüfen auf Passwort geändert oder nicht
$sql = "Select email From wslogin Where passwort geändert = 0";
$res = $conn->query($sql);
//Hier muss abgefragt werden können ob die email in den $res ergebnissen ist
if () {
    # code...
}
else {
    echo "Du hast dein Passwort schon verändert.\n"
}

if(//eingabe bei altes Passwort == $sPasswort)