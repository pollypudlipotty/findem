<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

    <div class="container">

        <!--BEJELENTKEZÉS-->

        <img id="registration-logo" src="/public/images/signIn_logo.png" alt="Bejelentkezés"
             class="img-fluid mx-auto d-block">
        <div class="row">
            <h2 class="text-center m-b-4 titles"><span>Bejelentkezés<span></h2>

        </div>

        <div class="container loginForm">
            <form action="/login/userLogin" method="POST">
            <div id="errorMessages"></div>

                <?php if (isset($message) && !empty($message)): ?>
                    <div class="alert alert-danger"><?php echo htmlentities($message); ?></div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="email-l" class="form-label">E-mail cím:</label>
                    <input type="email" class="form-control" id="email-l" name="email">
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Jelszó:</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <button type="submit" class="btn btn-primary" href="#" onclick="redirectToPage('/service_profile')">Bejelentkezés</button>
            </form>
        </div>
        <div class="container">
            <div class="row justify-content-center">
            <img src="/public/images/registration_logo.png" alt="Jelentkezz be!" class="img-fluid mx-auto d-block signIn-logo m-4">
                <h3>Nincs még fiókod?</h3>

                <div>
                    <a class="d-flex justify-content-center" href="#">
                        <button class="btn btn-primary position-center col col-md-2 m-4" onclick="redirectToPage('/registration')">Regisztrálj!</button>
                    </a>
                </div>

            </div>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>