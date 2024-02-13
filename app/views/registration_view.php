<?php include 'inc/header.php'; ?>

<div class="container">
    <!--NAVBAR-->

    <!--REGISZTRÁCIÓ-->
    <div class="row">
        <h2 class="text-center m-b-4 titles"><span>Regisztráció<span></h2>
    </div>
    <img id="registration-logo" src="/public/images/registration_logo.png" alt="Regisztráció" class="img-fluid mx-auto d-block">

    <div class="container registrationBox">
        <form action="/registrate/userRegistration" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Felhasználónév:</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail cim::</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="pass-1" class="form-label">Jelszó:</label>
                <input type="password" class="form-control" id="pass-1" name="pass-1" required>
            </div>
            <div class="mb-3">
                <label for="pass-2" class="form-label">Jelszó még egyszer:</label>
                <input type="password" class="form-control" id="pass-2" name="pass-2" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="provider-check" name="provider-check">
                <label class="form-check-label" for="provider-check">Szolgáltatóként is regisztrálok!</label>
            </div>
            <button type="submit" class="btn btn-primary">Regisztráció</button>
        </form>
    </div>
    <div class="container">
        <hr class="line">
    </div>
    <img src="./img/signIn_logo.png" alt="Jelentkezz be!" class="img-fluid mx-auto d-block signIn-logo">
    <div class="container">
        <div class="row justify-content-center">
            <h3>Van már fiókod?</h3>
            <button class="btn btn-primary position-relative col col-md-2" href="./signIn">Bejelentkezés</button>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>