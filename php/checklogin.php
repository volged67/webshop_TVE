<?php
 session_start();

 $sWidth = $_COOKIE['window_width'];
 $sHeight = $_COOKIE['window_height'];

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
           

            $_SESSION['id']=$row['userID'];
            $_SESSION['firstname']=$row['firstname'];
            $_SESSION['lastname']=$row['lastname'];
            $_SESSION['email']=$row['email'];
            $_SESSION['login']=111;
            $_SESSION['time']=time();
            $_SESSION['lastlogin']=$row['lastlogin'];
            $_SESSION['geschlecht']=$row['geschlecht'];
            //$_SESSION['firstlogin']=$bFirstlogin;

            $bLoginSuccess=true;
        }


        if ($bLoginSuccess) {


            // Selektiere die userdata und kontrolliere ob bereits die email vom input drinne steht
            $query=$conn->prepare("SELECT * FROM userdata WHERE email= ?");
            $query->execute([$sUsername]);
            $result = $query->rowCount();
            // Prüfen ob bereits ein eintrag für die userdata erstellt wurde, falls ja wird diese geupdatet
            if($result >0){
                $sqlUpdateUserData ="UPDATE userdata SET bildschirm=?, betriebssystem=?, email=?   WHERE email=?";
                $stmt=$conn->prepare($sqlUpdateUserData);
                $stmt->execute([$sWidth."x".$sHeight,$_SERVER['HTTP_USER_AGENT'],$sUsername,$sUsername]);

                //Wenn der User eingelogt wird wird logedin auf 1 gesetzt.
                if($bLoginSuccess)
                {
                    $sqllogedin="UPDATE user SET logedin ='1' WHERE user.email =?";
                    $stmt2=$conn->prepare($sqllogedin);
                    $stmt2->execute([$sUsername]);
                }
            }




            // falls kein eintrag in userdata für die emai drinne war wird diese neu erstellt in userdata
            else {
                $userdaten = "INSERT INTO userdata (bildschirm,betriebssystem,email)
                VALUES(?,?,?)";
                $stmt=$conn->prepare($userdaten);
                $stmt->execute([$sWidth."x".$sHeight,
                $_SERVER['HTTP_USER_AGENT'],$sUsername]);

                //Wenn der User eingelogt wird wird logedin auf 1 gesetzt.
                if($bLoginSuccess)
                {
                    $sqllogedin="UPDATE user SET logedin ='1' WHERE user.email =?";
                    $stmt2=$conn->prepare($sqllogedin);
                    $stmt2->execute([$sUsername]);
                }
            }
            
        }
        
    // //Wenn der User eingelogt wird wird logedin auf 1 gesetzt.
    //     if($bLoginSuccess)
    //     {
    //         $sqllogedin="UPDATE user SET logedin ='1' WHERE user.email =?";
    //          $stmt2=$conn->prepare($sqllogedin);
    //          $stmt2->execute([$sUsername]);
    //     }

    // //Einfügen der Log In Daten
    //     if ($bLoginSuccess) {
    //         $userdaten = "INSERT INTO userdata (bildschirm,betriebssystem,email)
    //         VALUES(?,?,?)";
    //         $stmt=$conn->prepare($userdaten);
    //         $stmt->execute(["X",
    //         php_uname(),$sUsername]);
    //     }

    //Beenden Der Datenbankverbindung
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