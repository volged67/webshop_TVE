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
                        <form id="login-form" class="form" action="Artikelseite.php" method="post">
                            <h3 class="text-center text-info">Vielen Dank für deinen Einkauf bei Huqqah in Kürze bekommst du eine Bestätigung per Mail.</h3>
                            
                            <br>
                            <!--Gleiche Bestellung nochmal Button-->

                            <h5 class="text-center text-info">Willst du die gleiche Bestellung nochmal durchführen dann klick auf diesen Button!</h5>
                            <div class="text-center text-info">
                                <input type="submit" value="Nochmal bestellen" id="login" class="btn btn-primary">
                            </div>    

                            <br>


                            <h5 class="text-center text-info">Ansonsten kannst du dich jetzt hier ausloggen!</h5>
                            <div class="text-center text-info">
                            <a class="nav-link" href="../php/logout.php">
                            <button type="button" class="btn btn-primary">Logout</button>
                            </a>
                            </div>   
                            
                            
                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>