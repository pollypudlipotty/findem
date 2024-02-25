<?php include 'inc/header.php'; ?>

    <div class="container">
        <!--NAVBAR-->
        <!--REGISZTRÁCIÓ-->
        <div class="row">
            <h2 class="text-center m-b-4 titles"><span>Regisztráció<span></h2>
        </div>
        <img id="registration-logo" src="/public/images/registration_logo.png" alt="Regisztráció"
             class="img-fluid mx-auto d-block">

        <div class="container registrationBox">
            <form action="/registration/userRegistration" method="POST">

                <div class="mb-3">
                    <label for="email-r" class="form-label">E-mail cim:</label>
                    <input type="email" class="form-control" id="email-r" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Vezetéknév:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>

                <div class="mb-3">
                    <label for="first_name" class="form-label">Keresztnév:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>

                <div class="mb-3">
                    <label for="pass1" class="form-label">Jelszó:</label>
                    <input type="password" class="form-control" id="pass1" name="pass1" required>
                </div>
                <div class="mb-3">
                    <label for="pass2" class="form-label">Jelszó még egyszer:</label>
                    <input type="password" class="form-control" id="pass2" name="pass2" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="provider_check" name="provider_check"
                           onchange="loadProviderForm();">
                    <label class="form-check-label" for="provider_check">Szolgáltatóként is regisztrálok!</label>
                </div>

                <div class="mb-3 provider_form">
                    <select class="form-control" id="service_category" name="service_category" >
                        <option value="0" selected disabled>Kategória:</option>

                        <?php foreach ($categories as $category): ?>

                            <option value="<?= $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3 provider_form">
                    <label for="company_name" class="form-label">Cég név:</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" >
                </div>

                <div class="mb-3 provider_form">
                    <select class="form-control" id="company_district" name="company_district" >
                        <option value="0" selected disabled>Kerület:</option>
                        <?php
                        for ($i = 1; $i < 24; $i++) {
                            echo "<option value='$i'>$i.</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3 provider_form">
                    <label for="company_address" class="form-label">Cím:</label>
                    <input type="text" class="form-control" id="company_address" name="company_address" >
                </div>

                <div class="mb-3 provider_form">
                    <label for="company_description" class="form-label">Leírás:</label>
                    <textarea class="form-control" id="company_description" name="company_description"
                              ></textarea>
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
                <a href="/login">
                    <button class="btn btn-primary position-relative col col-md-2">Bejelentkezés</button>
                </a>
            </div>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>
