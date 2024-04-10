<?php include 'inc/header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include 'inc/' . $nav; ?>

<!-- Foglalható időpontok -->

<div class="row col-12">
        <div class="d-inline-flex justify-content-center">
            <img class="servicesGif" src="/public/images/servicesGif.gif" alt="">
        </div>
        <div>
        <h2 class="text-center m-b-4 titles"><span>Szabad időpontok<span></h2>
        </div>
    </div>

<div class="container">
      <div class="row gy-3">
        <div class="col-md-4">
          <div class="card m-5">
            <div class="card-body">
              <h5 class="card-title">Szolgáltatás megnevezése</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: </span>adatbázisból</h6>
              <h6 class="card-subtitle mb-2 text-body-secondary"><span>helyszín: </span>adatbázisból</h6>
              <h6 class="card-subtitle mb-2 text-body-secondary"><span>megjegyzés: </span>Megjegyzés</h6>
              <a href="#" class="btn btnReserve">Foglalás</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card m-5">
            <div class="card-body">
              <h5 class="card-title">Fodrászat</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: </span>adatbázisból</h6>
              <h6 class="card-subtitle mb-2 text-body-secondary"><span>helyszín: </span>adatbázisból
              </h6>
              <h6 class="card-subtitle mb-2 text-body-secondary"><span>megjegyzés: </span>adatbázisból</h6>
              <a href="#" class="btn btnReserve">Foglalás</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card m-5">
            <div class="card-body">
              <h5 class="card-title">Masszázs</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: </span>adatbázisból</h6>
              <h6 class="card-subtitle mb-2 text-body-secondary"><span>helyszín: </span>adatbázisból</h6>
              <h6 class="card-subtitle mb-2 text-body-secondary"><span>megjegyzés: </span> adatbázisból</h6>
              <a href="#" class="btn btnReserve">Foglalás</a>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include 'inc/footer.php'; ?>