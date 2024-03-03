<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

<?php if (isset($message) && !empty($message)): ?>
    <div class="alert alert-success text-center"><?php echo $message; ?></div>
    <div class="container">
        <hr class="line">
    </div>
<?php endif; ?>

    <!--LEGKÖZELEBBI LEFOGLALHATÓ SZOLGÁLTATÁSOK-->
    <div class="container">
        <div class="row gy-3 category-sort">

            <?php foreach ($appointments as $appointment): ?>

            <div class="col-md-4">
                <div class="card m-5">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $appointment['category_name']; ?></h5>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: </span><?php echo $appointment['appointmentTime']; ?></h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>kerület: </span><?php echo $appointment['service_district']; ?>.</h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>megjegyzés: </span><?php echo $appointment['service_description']; ?></h6>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>

        </div>
    </div>

    <!--KATEGÓRIÁK-->
    <div>
        <div class="row">
            <h2 class="text-center m-b-4 titles"><span>Szolgáltatások<span></h2>
        </div>

        <div class="container categoriesOnHomePage">
            <div class="row justify-content-around">
                <?php foreach ($services as $service): ?>
                    <button class="btn btn-primary position-relative col m-2 serviceCategories" onclick="sortCategories(<?php echo $service['category_id']; ?>);"><?php echo $service['category_name']; ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- CAROUSEL-->

<div id="carouselExampleCaptions" class="carousel slide">
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
            <img src="/public/images/community_logo.png" class="d-block w-100 imgCarousel" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/public/images/community_logo.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/public/images/community_logo.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
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

<?php include 'inc/footer.php'; ?> 
