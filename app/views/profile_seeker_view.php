<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

<div class="container">

    <div class="row">
        <div class="col-4"></div>
        <div class="d-inline-flex justify-content-center col-4">
            <img class="servicesGif" src="/public/images/servicesGif.gif" alt="">
        </div>
        <div class="col-4"></div>
    </div>

    <div>
        <?php if (isset($message) && !empty($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>

    <!--SAJÁT PROFIL és ADATOK MÓDOSÍTÁSA-->
    <div class="row">
        <h2 class="text-center m-b-4 titles"><span>Saját profil<span></h2>
    </div>


    <div class="row">
        <div class="col-4 mt-3"></div>
        <div class="d-inline-flex justify-content-center col-4 mt-3">
            <img src="../../public/images/profil_logo.png" id="profil-logo" alt="Saját profil" class="img-fluid mx-auto d-block">
        </div>
        <div class="col-4 mt-3"></div>
    </div>

    <div class="row">
        <div class="col-1 mb-3 mt-3"></div>
        <div class="col-10 align-items-center text-center d-flex row userData mb-3 mt-3 justify-content-center">
                <div class="row"><h5><?php echo $userData['email_address']; ?></h5></div>
                <div class="row"><h5><?php echo $userData['last_name'] . ' ' . $userData['first_name']; ?></h5></div>
        </div>
        <div class="col-1 mb-3 mt-3"></div>
    </div>


    <div class="container" id="accountOptionsBox">
        <ul class="list-group">
            <li class="list-group-item userOptionBox"><a class="userOptions" href="#" onclick="redirectToPage('/seeker_profile/updateProfile')">Profil adatok módosítása</a></li>
            <li class="list-group-item userOptionBox"><a class="userOptions" href="#" onclick="redirectToPage('/seeker_profile/logout')">Kijelentkezés</a></li>   
            <li class="list-group-item userOptionBox"><a class="userOptions" href="#" onclick="displayProfileDel();">Profil törlése</a></li>
            <li class="profile-del list-group-item">
                <p>Biztosan törölni szeretnéd a profilodat?</p>
                <div class="text-center">
                    <a href="/seeker_profile/deleteProfile"><button class="btn btn-primary position-relative col m-2">Igen</button></a>
                    <button class="btn btn-primary position-relative col m-2" onclick="displayProfileDel();">Nem</button>
                </div>
            </li>

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

                        <div class="row">
                            <div class="col-0"></div>
                            <div class="col-12 reservationText position-relative mt-3 mb-3">
                                <h4 class="nothingsHere m-4">Nincsenek aktív foglalásaid.</h4>
                            </div>
                            <div class="col-0"></div>
                        </div>

                    <?php else: ?>

                        <?php foreach ($reservations as $reservation): ?>


                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlentities($reservation['category_name']); ?></h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>szolgáltató: </span>
                                            <?php echo htmlentities($reservation['service_name']); ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: </span>
                                            <?php echo htmlentities($reservation['appointmentTime']); ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>helyszín: </span>
                                            <?php echo htmlentities($reservation['service_district']) . ' kerület, ' . htmlentities($reservation['service_address']) . ' ' . htmlentities($reservation['service_housenumber']); ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>ár: </span>
                                            <?php echo htmlentities($reservation['appointment_fee']); ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>kontakt: </span>
                                            <?php echo htmlentities($reservation['email_address']); ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>leírás: </span>
                                            <?php echo htmlentities($reservation['service_description']); ?>
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
                    <div class="row">
                            <table class="table reservationTable col-12">
                                <thead class="reservations">
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
                                            <td><?php echo htmlentities($reservation['category_name']); ?></td>
                                            <td><?php echo htmlentities($reservation['appointmentTime']); ?></td>
                                            <td><?php echo htmlentities($reservation['appointment_fee']); ?></td>
                                            <td><?php echo htmlentities($reservation['service_name']); ?></td>
                                            <td><?php echo htmlentities($reservation['email_address']); ?></td>
                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                    </div>
                </div>


                <?php include 'inc/footer.php'; ?>
