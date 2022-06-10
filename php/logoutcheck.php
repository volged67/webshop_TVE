<?php
// Initialisierung der Session.
// Wenn Sie session_name("irgendwas") verwenden, vergessen Sie es
// jetzt nicht!
session_start();

//User ausloggen
//DB Settings
include 'dbsettings.php';

//Verbindung zur Datenbank
$conn = new PDO($dsn,$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Setzt den logedin wieder auf 0 in der Datenbank
$sUsername=$_SESSION["email"];
$sqllogedin="UPDATE user SET logedin ='0' WHERE user.email ='$sUsername'";
             $stmt2=$conn->prepare($sqllogedin);
             $stmt2->execute();

//Setzt den lastlogin auf die Logout Zeit
$sCurrentTime=date('Y-m-d H:i:s');
$sqllastlogin="UPDATE user SET lastlogin = '$sCurrentTime' WHERE user.email ='$sUsername'";
             $stmt3=$conn->prepare($sqllastlogin);
             $stmt3->execute();

// Löschen aller Session-Variablen.
$_SESSION = array();

// Falls die Session gelöscht werden soll, löschen Sie auch das
// Session-Cookie.
// Achtung: Damit wird die Session gelöscht, nicht nur die Session-Daten!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]
    );
}


// Zum Schluß, löschen der Session.
session_destroy();
?>