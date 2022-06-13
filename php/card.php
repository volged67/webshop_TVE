
<div class="card" style="width: 18rem;">
            <img class="card-img-top" src=<?php echo $row['bildlink']?> alt="Card image cap">
            <div class="card-body" style="color: black;">
              <h5 class="card-title"><?php echo $row['titel']?></h5>
              <p class="card-text"><?php echo $row['beschreibung']?></p>
              
              <a href="ablegenInWarenkorb.php?pid=<?php echo $row['id']?>"  class="btn btn-primary btn-sm">In den Warenkorb</a>
              
              <div class="badge bg-success text-wrap" style="width: 6rem;">
                <?php echo $row['preis']?>€
              </div>
            </div>
          </div>


