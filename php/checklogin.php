<?php
    $sUsername="";
    $sPassword="";
    $bLoginSuccess=false;

    if(isset($_POST['email']))
    {
        $sUsername=htmlspecialchars($_POST['email']);
    }
    if(isset($_POST['password']))
    {
        $sPassword=htmlspecialchars($_POST['password']);
    }

    if ($sUsername!=="" && $sPassword!=="")
    {
       //DB Settings
  include 'dbsettings.php';

  //Verbindung zur Datenbank
  $conn = new PDO($dsn,$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        

        $sql="SELECT*FROM users WHERE email='".$sUsername."'AND password='".$sPassword."'";

   
        foreach($conn->query($sql) as $row)
        {
            session_start();

            $_SESSION['id']=$row['id'];
            $_SESSION['vorname']=$row['vorname'];
            $_SESSION['nachname']=$row['nachname'];
            $_SESSION['email']=$row['email'];
            $_SESSION['login']=111;
            $_SESSION['time']=time();
            //$_SESSION['firstlogin']=$bFirstlogin;

            $bLoginSuccess=true;
        }
        
        $conn=null;

        if($bLoginSuccess)
        {
            header("Location: Startseite.php");
        }
        else
        {
            header("Location: login.php");
        }

    }
?>