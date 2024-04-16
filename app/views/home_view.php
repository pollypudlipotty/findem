<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

<?php if (isset($message) && !empty($message)): ?>
    <div class="alert alert-success text-center"><?php echo htmlentities($message); ?></div>
    <div class="container">
        <hr class="line">
    </div>
<?php endif; ?>

<!--LEGKÖZELEBBI LEFOGLALHATÓ SZOLGÁLTATÁSOK-->

<div class="row col-12">
    <div class="d-inline-flex justify-content-center">
        <img class="servicesGif" src="/public/images/servicesGif.gif" alt="">
    </div>
    <div>
        <h2 class="text-center m-b-4 titles mb-4"><span>Hamarosan lejáró ajánlatok<span></h2>
    </div>
</div>
<div class="container">
    <div class="row gy-3 category-sort">

        <?php if (empty($appointments)): ?>

            <div class="text-center my-5">
                <h4 class="text-center my-5">Nincsenek jelenleg aktív hirdetések.</h4>
                <h5">Látogass vissza később!</h5>
            </div>

        <?php else: ?>

            <?php foreach ($appointments as $appointment): ?>

                <div class="col-md-4 mb-4">
                    <div class="card m-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlentities($appointment['category_name']); ?></h5>
                            <hr>
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                <span>időpont: </span><?php echo htmlentities($appointment['appointmentTime']); ?></h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                <span>kerület: </span><?php echo htmlentities($appointment['service_district']); ?>.</h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                <span>megjegyzés: </span><?php echo htmlentities($appointment['service_description']); ?></h6>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<!--KATEGÓRIÁK-->
<div>
    <div class="row col-12">
        <h2 class="text-center m-b-4 titles"><span>Szolgáltatások<span></h2>
    </div>

    <div class="container categoriesOnHomePage">
        <div class="row justify-content-around">
            <?php foreach ($services as $service): ?>
                <button class="btn btn-primary position-relative col m-2 serviceCategories"
                        onclick="sortCategoriesHome(<?php echo $service['category_id']; ?>);"><?php echo htmlentities($service['category_name']); ?></button>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- CAROUSEL-->

<div id="carouselExampleCaptions" class="carousel slide container">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/public/images/carousel_registration.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>INGYENES REGISZTRÁCIÓ</h5>
                <p>Könnyű és ingyenes regisztáció, amivel szolgáltatóként is pár kattintással csatlakozhatsz
                    csapatunkhaoz.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/public/images/carousel_community.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>NAGYSZERŰ KÖZÖSSÉG</h5>
                <p>Csapatunk egyik célkitűzése a közösségépítés és hogy összehozzuk az embereket.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/public/images/carousel_services.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>FOLYAMATOSAN BŐVÜLŐ SZOLGÁLTATÁSOK</h5>
                <p>Kezdő vállalkozásként fontos számunkra a folyamatos fejlődés és a szakemberek minél szélesebb körének
                    bevonása a csapatba.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



<!-- CSATLAKOZZ-->

<div class="d-flex justify-content-center joinUSBox">
    <div>
        <div>
            <img src="/public/images/joinUs_logo.png" class="mx-auto d-block joinUsPicture" alt="Join US!">
        </div>
        <div>

            <h3><a id="joinUsText" class="link-underline link-underline-opacity-0" href="#" onclick="redirectToPage('/registration')">Csatlakozz hozzánk és regisztálj!</a></h3>

        </div>
    </div>

</div>


<?php include 'inc/footer.php'; ?> 
