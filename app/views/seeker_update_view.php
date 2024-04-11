<?php include 'inc/header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include 'inc/' . $nav; ?>

<img id="registration-logo" src="/public/images/registration_logo.png" alt="Regisztráció" class="img-fluid mx-auto d-block">

<div class="row">
        <h2 class="text-center m-b-4 titles"><span>Profil adatok módosítása<span></h2>
</div>

<div class="row col-12 d-flex justify-content-center">
    <div class="card w-50 m-4 mt-5 profilUpdate">
        <div>
            <h4>Jelszó módosítása</h4>
            <?php if (isset($message) && !empty($message)): ?>
                    <div class="alert alert-danger"><?php echo htmlentities($message); ?></div>
            <?php endif; ?>
            <form class="mt-4" action="/seeker_profile/updatePassword" method="POST">
                <label for="oldPassword">Régi jelszó:</label>
                <input type="password" name="oldPassword">
                <label for="newPassword">Új jelszó</label>
                <input type="password" name="newPassword">
                <div>
                    <button type="submit" class="btn btn-primary m-4 ms-0" onclick="">Mentés</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>