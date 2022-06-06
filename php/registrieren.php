<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>huqqah-Registrieren</title>
    <!--Verlinkungen-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
    <?php
    include 'navbar.php';
    ?>

    <div id="login">
        <h3 class="text-center text-white pt-5">Registrieren</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Registrieren</h3>

                            <form action="?register=1" method="post">
                                <form method="POST" action="../PHPMailer/index.php" id="regForm" class="form-horizontal" role="form">
                                    <div class="container">
                                        <div class="row">
    	                               
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="text-info">Vorname</label> <br>
                                            <input id="regVorname" type="text" name="vorname" id="vorname" class="form-control" placeholder="Max"><br>
                                        
                                            <label for="name" class="text-info">Nachname</label><br>
                                            <input id="regNachname" type="text" name="nachname" id="nachname" class="form-control" placeholder="Mustermann"><br>
                                                <label for="exampleInputEmail1" class="text-info">E-Mail</label><br>
                                                <input id="regEmail" type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" placeholder="maxmustermann@gmail.com"><br>
                                                <label for="name" class="text-info">Straße</label><br>
                                                <input id="regStrasse" type="text" class="form-control" placeholder="Altburgstr.150"><br>
                                                <label for="name" class="text-info">Ort</label><br>
                                                <input id="regOrt" type="text" class="form-control" placeholder="Reutlingen"><br>
                                                <label for="name" class="text-info">PLZ</label><br>
                                                <input id="regPlz" type="text" class="form-control" placeholder="72762"><br>
                                                <input id="regBtn"class="btn btn-primary" type="submit" class="btn btn-primary" value="Erstellen Sie Ihr Konto">
                                            </div>
                                            <div class="col">

                                            </div>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>