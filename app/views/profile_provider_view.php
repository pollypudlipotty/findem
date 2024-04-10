<?php include 'inc/header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include 'inc/' . $nav; ?>

<div class="container">

    <div>
        <?php if (isset($message) && !empty($message)): ?>
            <div class="alert alert-success"><?php echo htmlentities($message); ?></div>
        <?php endif; ?>
    </div>

    <!--SAJÁT PROFIL és ADATOK MÓDOSÍTÁSA-->
    <div class="row">
        <h2 class="text-center m-b-4 titles"><span>Saját profil<span></h2>
    </div>
    <img src="../../public/images/profil_logo.png" id="profil-logo" alt="Saját profil"
         class="img-fluid mx-auto d-block">
    <div class="container" id="accountOptionsBox">
        <ul class="list-group">

            <li class="list-group-item"><a href="#" onclick="redirectToPage('/service_profile/updateProfile')">Profil adatok módosítása</a></li>
            <li class="list-group-item"><a href="#" onclick="redirectToPage('/service_profile/logout')">Kijelentkezés</a></li>
            <li class="list-group-item"><a href="#" onclick="displayProfileDel();">Profil törlése</a></li>

            <li class="profile-del list-group-item">
                <p>Biztosan törölni szeretnéd a profilodat?</p>
                <div class="text-center">
                    <a href="/service_profile/deleteProfile"><button class="btn btn-primary position-relative col m-2">Igen</button></a>
                    <button class="btn btn-primary position-relative col m-2" onclick="displayProfileDel();">Nem</button>
                </div>

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
                <div class="row gy-3 free-appointments">

                    <?php if (empty($freeAppointments)): ?>

                        <h4>Nincsenek meghirdetett szabad időpontjaid.</h4>

                    <?php else: ?>

                        <?php foreach ($freeAppointments as $appointment): ?>

                            <div class="col-md-4">
                                <div class="card m-5">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: </span>
                                            <?php echo htmlentities($appointment['appointmentTime']); ?>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>ár: </span>
                                            <?php echo htmlentities($appointment['appointment_fee']); ?> Ft
                                        </h6>
                                        <button class="btn btnReserve"
                                                onclick="deleteAppointment(<?php echo htmlentities($appointment['appointment_id']); ?>);">
                                            Törlés
                                        </button>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>
                <!--ÚJ IDŐPONT-->
                <div class="container">
                    <div class="row justify-content-center">
                        <a href="/new_appointment">
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

                                <?php if (empty($upcomingAppointments)): ?>

                                    <h4>Nincsenek lefoglalt időpontjaid.</h4>

                                <?php else: ?>

                                    <?php foreach ($upcomingAppointments as $appointment): ?>

                                        <div class="col-md-4">
                                            <div class="card m-5">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-body-secondary">
                                                        <span>időpont: </span><?php echo htmlentities($appointment['appointmentTime']); ?>
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2 text-body-secondary"><span>ár: </span>
                                                        <?php echo htmlentities($appointment['appointment_fee']); ?> Ft
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2 text-body-secondary">
                                                        <span>vendég neve: </span>
                                                        <?php echo htmlentities($appointment['last_name']) . ' ' . htmlentities($appointment['first_name']); ?>
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2 text-body-secondary">
                                                        <span>vendég email cime: </span><?php echo htmlentities($appointment['email_address']); ?>
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
                                        <th scope="col">Időpont</th>
                                        <th scope="col">Ár</th>
                                        <th scope="col">Vendég neve</th>
                                        <th scope="col">Vendég email címe</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($pastAppointments as $appointment): ?>

                                        <tr>
                                            <td><?php echo htmlentities($appointment['appointmentTime']); ?></td>
                                            <td><?php echo htmlentities($appointment['appointment_fee']); ?></td>
                                            <td><?php echo htmlentities($appointment['last_name']) . ' ' . htmlentities($appointment['first_name']); ?></td>
                                            <td><?php echo htmlentities($appointment['email_address']); ?></td>
                                        </tr>

                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <?php include 'inc/footer.php'; ?>
