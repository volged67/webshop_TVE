<?php
session_start();

  // error_reporting(-1);
  // ini_set('display_errors','On');
  
//DB Settings
  include 'dbsettings.php';

//Verbindung zur Datenbank
$db = new PDO($dsn,$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$userid=$_SESSION['id'];
$userwaren ="SELECT * FROM warenkorb WHERE userid=$userid";

$result = $db->query($userwaren);

 //Artikelsumme im Warenkorb
 $amount="SELECT SUM(psumme) FROM warenkorb WHERE userid=$userid";

 foreach($db->query($amount) as $row)
       {
           $sSumme=$row['SUM(psumme)'];
       }



?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Warenkorb</title>
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     
     <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
</head>
<body>
    <!-- Navigationsleiste -->
    <?php
    include 'navbar.php';
    ?>
    <!-- Tabelle mit Artikeln im Warenkorb -->
<!-- <form action="zuBestellungHinzufuegen.php" method = "post"> -->

    <section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Warenkorb</h3>
        </div>

        <?php while($row = $result->fetch()):?>
          <div class="row">
          
          

            <div class="col">
              <?php
                //Artikel einfügen
                
                echo "
                
                <div class='card rounded-3 mb-4'>
                        <div class='card-body p-4'>
                          <div class='row d-flex justify-content-between align-items-center'>
                            <div class='col-md-2 col-lg-2 col-xl-2'>
                              <img src='../img/".$row['pbildlink']."'
                              class='img-fluid rounded-3' alt='Cotton T-shirt'>
                            </div>
                            <div class='col-md-3 col-lg-3 col-xl-3'>
                              <p class='lead fw-normal mb-2'>".$row['ptitel']."</p>
                              <p><span class='text-muted'>Preis: </span>".$row['ppreis']."</p>
                            </div>

                            

                            <div class='col-md-3 col-lg-3 col-xl-2 d-flex'>
                            
                              <form action='updateWarenkorb.php?pid=".$row['pid']."' method='post'>
                              <input id='form1' min='0' name='quantity' value='".$row['panzahl']."' type='number'
                                class='form-control form-control-sm' />
                                </form>

                              
                              
                            </div>
                            <div class='col-md-3 col-lg-2 col-xl-2 offset-lg-1'>
                              <h5 class='mb-0'>Summe:<br>".sprintf("%01.2f", $row['psumme'])."</h5>
                              <h5 class='mb-0'>Rabatt:<br>".$row['rabatt']." %</h5>
                            </div>
                            <div class='col-md-2 col-lg-2 col-xl-2'>
                            <a href='loeschenAusWarenkorb.php?wid=".$row['wid']." class='text-danger'><i class='btn-close'></i></a>
                            </div>
                          </div>
                        </div>
        </div>
      
        ";
        
        

              ?>
            </div>

        

        </div>
        <?php endwhile;?>

        <div class="card">
          <div class="card-body">
            <label for="password" class="text-info">Gesamtsumme:</label><br>
            <label for="gesamtsumme" class="text-info"><?php echo 
            sprintf("%01.2f", $sSumme);
            ?> 
            </label><br>
            <!-- <label for="Mengenrabatt" class="text-info">Mengenrabatt: 
            <?php 
              // if (($row['panzahl'])>=8 && ($row['panzahl'])<16) {
              //   echo "8%";
              // }
              // if (($row['panzahl'])>16) {
              //   echo "16%";
              // }
              // else {
              //   echo "0%";
              // }
            ?>
            </label> -->
            <br>
          </div>
        </div>
        <br>

        <form action="zuBestellungHinzufuegen.php" method = "post">
        <div class="card">
          <div class="card-body">
            <button type="submit" class="btn btn-warning btn-block btn-lg">Zur Bestellung</button>
          </div>
        </div>
        </form>

      </div>
    </div>
  </div>

        
</section>

<!-- <script src="../node_modules/jquery/dist/jquery.js"></script> -->

<!-- <script>
function testplus(event){
  console.log("+");
  console.dir(event);
  console.log(event.parentElement.childNodes[3].value);
  let inputartikelx=event.parentElement.childNodes[3];
  console.log(inputartikelx.value);
  inputartikelx.value = (Number(inputartikelx.value) +1);
  console.log(inputartikelx.value);

  //Variable zum Übergeben definieren
  var jsvar = inputartikelx.value;

  //Test 1
  window.location.href = "test.php?jsvar=" + jsvar;
  //window.location.href = "test.php?jsvar2=" + jsvar2;

}
  

function testminus(event){
  console.log("-");
  console.dir(event);
  console.log(event.parentElement.childNodes[3].value);
  let inputartikelx=event.parentElement.childNodes[3];
  console.log(inputartikelx.value);
  inputartikelx.value = (Number(inputartikelx.value) -1);
  console.log(inputartikelx.value);
}

fetch('https://jsonplaceholder.typicode.com/posts',{
  method:'POST',
  headers:{
    'content-type':'application/json;charset=UTF-8'
  },
  body:JSON.stringify({
    title:'fetch',
    body:'JS-fetchdemo',
    Pid: 1
  })
})
.then(response => {
  if(response.ok){
    console.log("Erfolgreich!");
    return response.json();
  }
  else{
    throw new Error("Fehler bei POST");
  }
})
.then(data => console.log(data))
.catch((error) => console.log(error))

</script> -->

</body>
</html>