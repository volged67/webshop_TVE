<?php
 session_start();

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

        

  $sql="SELECT*FROM user WHERE email='".$sUsername."'AND password='".hash('sha512',$sPassword)."'";

   
        foreach($conn->query($sql) as $row)
        {
           

            //$_SESSION['id']=$row['id'];
            $_SESSION['firstname']=$row['firstname'];
            $_SESSION['lastname']=$row['lastname'];
            $_SESSION['email']=$row['email'];
            $_SESSION['login']=111;
            $_SESSION['time']=time();
            //$_SESSION['firstlogin']=$bFirstlogin;

            $bLoginSuccess=true;
        }
        
        

    //Wenn der User eingelogt wird wird logedin auf 1 gesetzt.
        if($bLoginSuccess)
        {
            $sqllogedin="UPDATE user SET logedin ='1' WHERE user.email =?";
             $stmt2=$conn->prepare($sqllogedin);
             $stmt2->execute([$sUsername]);
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