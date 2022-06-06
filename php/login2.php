<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ShoeShop Login</title>
    <?php include "head.php"; ?>
</head>
<body>
    <div class="container-fluid">
        <div class="header"></div>
        <div class="row">
            <div class="col"></div>
            <div class="col align-content-center">
               <div class="row mt-3"><img src="../images/Logo(cut).jpeg" onclick="" alt="Logo"></div>
                <h1 class="text-center">ShoeShop</h1>
                <h3 class="text-center">Anmelden</h3>
                <form action="checklogin.php" method="post">
                    <div class="row justify-content-center">
                    <label class="text-center form-label">Benutzername</label><br>
                    <input class="text-center form-control" type="mail" name="email"><br>
                    <label class="text-center form-label">Password</label><br>
                    <input type="password" name="password" class="form-control mb-4 text-center"><br>
                    <button type="submit" class="btn btn-success">Einloggen!</button>
                    </div>
                </form>
                <div class="row mt-1">
                    <b class="text-center">Noch kein Konto? - <a href="registration.php">Registrieren</a></b>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>