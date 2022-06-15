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
    

    <div id="login">
        <h3 class="text-center text-white pt-5">Registrieren</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="checkreg.php" method="post">
                            <h3 class="text-center text-info">Registrieren</h3>

                                <form method="POST" action="checkreg.php" class="form-horizontal" role="form">
                                    <div class="container">
                                        <div class="row">
    	                               
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="text-info">Vorname</label> <br>
                                            <input id="regVorname" type="text" name="firstname"  class="form-control" placeholder="Max"><br>
                                        
                                            <label for="name" class="text-info">Nachname</label><br>
                                            <input id="regNachname" type="text" name="lastname"  class="form-control" placeholder="Mustermann"><br>
                                                <label for="exampleInputEmail1" class="text-info">E-Mail</label><br>
                                                <input id="regEmail" type="mail" name="email" class="form-control" aria-describedby="emailHelp" placeholder="maxmustermann@gmail.com"
                                                pattern=".{3,}[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="E-Mail Format falsch!"  autocomplete="off">
                                                <br>
                                                <label for="name" class="text-info">Straße</label><br>
                                                <input id="regStrasse" type="text" name="street" class="form-control" placeholder="Altburgstr.150"><br>
                                                <label for="name" class="text-info">Ort</label><br>
                                                <input id="regOrt" type="text" name="city" class="form-control" placeholder="Reutlingen"><br>
                                                <label for="name" class="text-info">PLZ</label><br>
                                                <input id="regPlz" type="text" name="plz" class="form-control" placeholder="72762"><br>
                                                <input id="regBtn"class="btn btn-primary" type="submit" class="btn btn-primary" >
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