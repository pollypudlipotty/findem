<?php include 'inc/header.php'; ?>

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

    <div class="container categoriesOnHomePage">
        <div class="row justify-content-around">
            <?php foreach ($services as $service): ?>
                <button class="btn btn-primary position-relative col m-2 serviceCategories"
                        onclick="sortCategories(<?php echo $service['category_id'] . ',' . $_SESSION['user_role']; ?>);"><?php echo htmlentities($service['category_name']); ?></button>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container">
        <div class="row gy-3 appointment-sort">

            <?php if (empty($appointments)): ?>

                <div class="text-center my-5">
                    <h4 class="text-center my-5">Nincsenek jelenleg aktív hirdetések.</h4>
                    <h5>Látogass vissza később!</h5>
                </div>

            <?php else: ?>

                <?php foreach ($appointments as $appointment) : ?>

                    <div class="col-md-4">
                        <div class="card m-0 h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlentities($appointment['category_name']); ?></h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>szolgáltató: </span><?php echo htmlentities($appointment['service_name']); ?>
                                </h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>időpont: </span><?php echo htmlentities($appointment['appointmentTime']); ?>
                                </h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>helyszín: </span><?php echo htmlentities($appointment['service_district']) . '. kerület, ' . htmlentities($appointment['service_address']) . ' ' . htmlentities($appointment['service_housenumber']); ?>
                                </h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>ár: </span><?php echo htmlentities($appointment['appointment_fee']); ?></h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>megjegyzés: </span><?php echo htmlentities($appointment['service_description']); ?>
                                </h6>

                                <?php if ($_SESSION['user_role'] === 1): ?>
                                    <a href="#" class="btn btnReserve"
                                       onclick="reserveAppointment(<?php echo $appointment['appointment_id']; ?>);">Foglalás</a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </div>

<?php include 'inc/footer.php'; ?>