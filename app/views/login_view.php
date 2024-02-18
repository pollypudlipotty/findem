<?php include 'inc/header.php'; ?>

    <div class="container">
        <!--NAVBAR-->

        <!--REGISZTRÁCIÓ-->
        <div class="row">
            <h2 class="text-center m-b-4 titles"><span>Bejelentkezés<span></h2>
        </div>

        <div class="container registrationBox">
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Felhasználónév:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">E-mail cím:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Jelszó:</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
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