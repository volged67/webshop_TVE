<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    

</head>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="checklogin.php" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">e-Mail</label><br>
                                <input type="email" name="email" class="form-control">
                            </div> 
                             <div class="form-group">
                                <label for="password" class="text-info">Passwort:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" value="Login" id="login" class="btn btn-primary">
                            </div>    
                                         
                            <div id="register-link" class="text-right">
                                <a href="registrierung.php" class="text-info">Registrieren</a>
                            </div>
                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>