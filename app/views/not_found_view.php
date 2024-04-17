<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

<div class="container text-center">
    <!--NO FOUND-->

    <img src="/public/images/notFound_logo.png" alt="About Us" class="img-fluid mx-auto d-block aboutUs-logo">

    <p><h5 class="nothingsHere">Hoppá! Nem találjuk az oldalt, amit keresel.</h5></p>
    <p><button class="btn btn-primary position-center col col-md-2 m-4" onclick="redirectToPage('/home')">Vissza a főoldalra</button></p>

</div>

<?php include 'inc/footer.php'; ?>
