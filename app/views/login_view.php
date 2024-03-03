<?php include 'inc/header.php'; ?>

    <div class="container">

        <!--BEJELENTKEZÉS-->
        <div class="row">
            <h2 class="text-center m-b-4 titles"><span>Bejelentkezés<span></h2>
        </div>

        <div class="container registrationBox">
            <form action="/login/userLogin" method="POST">
                <div class="mb-3">
                    <label for="email-l" class="form-label">E-mail cím:</label>
                    <input type="email" class="form-control" id="email-l" name="email">
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Jelszó:</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <button type="submit" class="btn btn-primary">Bejelentkezés</button>
            </form>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <h3>Nincs még fiókod?</h3>
                <a href="/registration">
                    <button class="btn btn-primary position-relative col m-2">Regisztrálj!</button>
                </a>
            </div>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>