<form action="ablegenInWarenkorb.php?pid=<?php echo $row['id']?>" method = "post">
<div class="card" style="width: 18rem;">
            <img class="card-img-top" src=<?php echo $row['bildlink']?> alt="Card image cap">
            <div class="card-body" style="color: black;">
              <h5 class="card-title"><?php echo $row['titel']?></h5>
              <p class="card-text"><?php echo $row['beschreibung']?></p>
              
              <button class="btn btn-primary btn-sm" type="submit">In den Warenkorb</button>
              <!-- <a href="ablegenInWarenkorb.php?pid=<?php echo $row['id']?>"  class="btn btn-primary btn-sm" type="submit">In den Warenkorb</a> -->
              
              <div class="badge bg-success text-wrap" style="width: 6rem;">
                <?php echo $row['preis']?>€
              </div>
              <div>
                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fas fa-minus"></i>
                </button>

                <input id="form1" min="0" name="anzahl" value="0" type="number"
                  class="form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="fas fa-plus"></i>
                </button>
                <div>
                  <p>Verfügbare Menge:<?php echo $row['menge']?></p>
                </div>
              </div>
            </div>
          </div>
</form>


