<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

<div class="container">
    <!--SAJÁT PROFIL és ADATOK MÓDOSÍTÁSA-->
    <div class="row">
        <h2 class="text-center m-b-4 titles"><span>Saját profil<span></h2>
    </div>
    <img src="../../public/images/profil_logo.png" id="profil-logo" alt="Saját profil"
        class="img-fluid mx-auto d-block">
    <div class="container" id="accountOptionsBox">
        <ul class="list-group">
            <li class="list-group-item"><a href="">Profil adatok módosítása</a></li>
            <li class="list-group-item"><a href="/service_profile/logout">Kijelentkezés</a></li>
            <li class="list-group-item"><a href="">Profil törlése</a></li>
        </ul>

    </div>


    <div class="container">
        <hr class="line">
    </div>
    <!--SZABAD IDŐPONTJAIM-->
    <div class="container">
        <div class="row justify-content-center">
            <h3>Foglalható időpontjaim</h3>
        </div>
        <div class="container">
            <div class="container">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <div class="card m-5">
                            <div class="card-body">
                                <h5 class="card-title">Szolgáltatás megnevezése</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: </span>adatbázisból
                                </h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><span>helyszín: </span>adatbázisból
                                </h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><span>megjegyzés: </span>Megjegyzés
                                </h6>
                                <a href="#" class="btn btnReserve">Törlés</a>
                            </div>
                        </div>
                    </div>
<!--ÚJ IDŐPONT-->
<div class="container">
    <div class="row justify-content-center">
        <a href="/appointmentRegistration_view.php">
            <button class="btn btn-primary position-relative col m-2">Új időpont feltöltése</button>
        </a>
    </div>
                </div>
                <div class="container">
                    <hr class="line">
                </div>

    <!--LEFOGLALT IDŐPONTOK-->
    <div class="container">
        <div class="row justify-content-center">
            <h3>Lefoglalt időpontok</h3>
        </div>
        <div class="container">
            <div class="container">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <div class="card m-5">
                            <div class="card-body">
                                <h5 class="card-title">Szolgáltatás megnevezése</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: </span>adatbázisból
                                </h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><span>helyszín: </span>adatbázisból
                                </h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><span>megjegyzés: </span>Megjegyzés
                                </h6>
                                <a href="#" class="btn btnReserve">Időpont törlése</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="container">
                    <hr class="line">
                </div>
    <!--KORÁBBI FOGLALÁSOK-->
    <div class="row justify-content-center">
        <h3>Korábbi foglalások</h3>
    </div>
    <div class="container">
        <table class="table reservationTable">
            <thead>
                <tr>
                    <th scope="col">Szolgáltató</th>
                    <th scope="col">Szolgáltatás típusa</th>
                    <th scope="col">Időpont</th>
                    <th scope="col">Helyszín</th>
                    <th scope="col">Megjegyzés</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>user-1</td>
                    <td>service-1</td>
                    <td>time-1</td>
                    <td>place-1</td>
                    <td>comment-1</td>
                </tr>
                <tr>
                    <td>user-2</td>
                    <td>service-2</td>
                    <td>time-2</td>
                    <td>place-2</td>
                    <td>comment-2</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<?php include 'inc/footer.php'; ?>
