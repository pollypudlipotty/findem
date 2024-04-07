<?php include 'inc/header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include 'inc/' . $nav; ?>

<div class="container">

    <div>
        <?php if (isset($message) && !empty($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>

    <!--SAJÁT PROFIL és ADATOK MÓDOSÍTÁSA-->
    <img src="../../public/images/profil_logo.png" id="profil-logo" alt="Saját profil"
         class="img-fluid mx-auto d-block">
    <div class="row">
        <h2 class="text-center m-b-4 titles"><span>Saját profil<span></h2>
    </div>
    <div class="container" id="accountOptionsBox">
        <ul class="list-group">
            <li class="list-group-item"><a href="/seeker_profile/updateProfile">Profil adatok módosítása</a></li>
            <li class="list-group-item"><a href="/seeker_profile/logout">Kijelentkezés</a></li>
            <li class="list-group-item"><a href="">Profil törlése</a></li>
        </ul>

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

                    <?php if (empty($reservations)): ?>

                        <h4>Nincsenek aktív foglalásaid.</h4>

                    <?php else: ?>

                        <?php foreach ($reservations as $reservation): ?>


                            <div class="col-md-4">
                                <div class="card m-5">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $reservation['category_name']; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>szolgáltató: </span>
                                            <?php echo $reservation['service_name']; ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>helyszín: </span>
                                            <?php echo $reservation['service_district'] . ' kerület, ' . $reservation['service_address'] . ' ' . $reservation['service_housenumber']; ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>ár: </span>
                                            <?php echo $reservation['appointment_fee']; ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>kontakt: </span>
                                            <?php echo $reservation['email_address']; ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>leírás: </span>
                                            <?php echo $reservation['service_description']; ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

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

                            <th scope="col">Szolgáltatás típusa</th>
                            <th scope="col">Időpont</th>
                            <th scope="col">Ár</th>
                            <th scope="col">Szolgáltató</th>
                            <th scope="col">Kontakt</th>
                        </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($pastReservations  as $reservation): ?>

                                <tr>
                                    <td><?php echo $reservation['category_name']; ?></td>
                                    <td><?php echo $reservation['appointmentTime']; ?></td>
                                    <td><?php echo $reservation['appointment_fee']; ?></td>
                                    <td><?php echo $reservation['service_name']; ?></td>
                                    <td><?php echo $reservation['email_address']; ?></td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>


                <?php include 'inc/footer.php'; ?>
