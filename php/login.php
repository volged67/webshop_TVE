<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    

</head>


        <script type="text/javascript">    
        document.cookie = 'window_width='+screen.width+'; expires=Fri, 3 Aug 2901 20:47:11 UTC; path=/';    
        document.cookie = 'window_height='+screen.height+'; expires=Fri, 3 Aug 2901 20:47:11 UTC; path=/'; 
        </script>




<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="checklogin.php" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <!--Mail Adresse Eingabefeld-->
                            <div class="form-group">
                                <label for="email" class="text-info">e-Mail</label><br>
                                <input type="mail" name="email" class="form-control">
                            </div> 
                            <!--Passwort Eingabefeld-->
                             <div class="form-group">
                                <label for="password" class="text-info">Passwort:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <!--Konto erstellen Button-->
                            <div class="form-group">
                                <input type="submit" value="Login" id="login" class="btn btn-primary">
                            </div>    
                            <!--Registrierungslink-->       
                            <div id="register-link" class="text-right">
                                <a href="registrieren.php" class="text-info">Registrieren</a>
                            </div>
                            <!--Registrierungslink-->       
                            <div id="register-link" class="text-right">
                                <a href="passwortZuruck.php" class="text-info">Passwort zur??cksetzen</a>
                            </div>
                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>