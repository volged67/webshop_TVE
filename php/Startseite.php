<?php
session_start();
// Check ob man schon eingeloggt ist
if($_SESSION['login']!=111)
{
header("Location: Login.php");
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>huqqah</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="module">
      import { Toast } from 'bootstrap.esm.min.js'
    
      Array.from(document.querySelectorAll('.toast'))
        .forEach(toastNode => new Toast(toastNode))
    </script>

</head>
<body>
    
    <div class="container">
      <div class="p-3 mb-2 bg-secondary text-white">

<!-- Navigationsleiste einfügen -->
 <?php
    include 'navbar.php';
  ?>

<!-- Begrüßung (noch zu bearbeiten) -->
<h1>Herzlich Willkommen</h1>
        <p>Schön, dass du hier bist <b><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></b></p>
        <?php $lesbaresDatum = date("d.M.Y H:i:s");?>
        <p>Du warst das letzte mal am  <b><?php echo $lesbaresDatum ?></b> eingeloggt. <b>

 
          
<!-- Bilderkarousel -->
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../img/aeon.jpg"  class="d-block w-100" style="max-width: 900px; margin: 0 auto">
                <div class="carousel-caption d-none d-md-block">
                  <h5 class="text-dark">Aeon Lounge</h5>
                  <p class="text-dark">Gefühlvoll gezogene Linien</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="../img/Kaloud.jpg" class="d-block w-100" style="max-width: 900px; margin: 0 auto" >
                <div class="carousel-caption d-none d-md-block">
                  <h5>Kaloud 2.0</h5>
                  <p>Kraftvoll und wunderschön</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="../img/litlip.jpg" class="d-block w-100" style="max-width: 900px; margin: 0 auto" >
                <div class="carousel-caption d-none d-md-block">
                  <h5 class="text-dark">Hookain LitLip</h5>
                  <p class="text-dark">Ein Farbverlauf zum einrahmen</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
</div>

</body>
</html>