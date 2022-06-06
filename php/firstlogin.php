<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>First Login</title>
     <!-- Bootstrap -->
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
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Neues Passwort vergeben!</h3>
                            <br>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Altes Passwort:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password" class="text-info">Neues Passwort:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            
                            <div class="form-group">
                              
                                <a href="../php/Startseite.php" class="btn btn-primary"  type="button">login </a>
                            </div>    
                                         
                            <div id="register-link" class="text-right">
                                <a href="../php/registrieren.php" class="text-info">Registrieren</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>