<div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img src=<?php echo $row['pbildlink']?>
                class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><?php echo $row['ptitel']?></p>
                <p><span class="text-muted">Preis: </span><?php echo $row['ppreis']?></p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fas fa-minus"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="<?php echo $row['panzahl']?>" type="number"
                  class="form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0"><?php echo $row['ppreis']?></h5>
              </div>
              <div class="col-md-2 col-lg-2 col-xl-2">
              <a href="loeschenAusWarenkorb.php?wid=<?php echo $row['wid']?>" class="text-danger"><i class="btn-close"></i></a>
              </div>
            </div>
          </div>
        </div>
