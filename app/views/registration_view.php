<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

    <div class="container">
        <!--REGISZTRÁCIÓ-->

        
        <img id="registration-logo" src="/public/images/registration_logo.png" alt="Regisztráció"
             class="img-fluid mx-auto d-block">

        <div class="row">
            <h2 class="text-center m-b-4 titles"><span>Regisztráció<span></h2>
        </div>

        <div class="container registrationBox">
            <form action="/registration/userRegistration" id="registrationForm" method="POST">
                <div id="errorMessages"></div>

                <?php if (isset($message) && !empty($message)): ?>
                    <div class="alert alert-danger"><?php echo htmlentities($message); ?></div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="email-r" class="form-label">E-mail cím:</label>
                    <input type="email" class="form-control" id="email-r" name="email">
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Vezetéknév:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>

                <div class="mb-3">
                    <label for="first_name" class="form-label">Keresztnév:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>

                <div class="mb-3">
                    <label for="pass1" class="form-label">Jelszó:</label>
                    <input type="password" class="form-control" id="pass1" name="pass1">
                </div>
                <div class="mb-3">
                    <label for="pass2" class="form-label">Jelszó megerősítése:</label>
                    <input type="password" class="form-control" id="pass2" name="pass2">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="provider_check" name="provider_check"
                           onchange="loadProviderForm();">
                    <label class="form-check-label" for="provider_check">Szolgáltatóként regisztrálok!</label>
                </div>

                <div class="mb-3 provider_form">
                <label for="company_district">Kategória:</label>
                    <select class="form-control" id="service_category" name="service_category">
                        <option value="0" selected disabled>Válasszon kategóriát</option>

                        <?php foreach ($categories as $category): ?>

                            <option value="<?= $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3 provider_form">
                    <label for="company_name" class="form-label">Cég neve:</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" >
                </div>
                
                <div class="mb-3 provider_form">
                    <label for="company_description" class="form-label">Leírás:</label>
                    <textarea class="form-control" id="company_description" name="company_description"
                              ></textarea>
                </div>

                <div class="mb-3 provider_form">
                <h5>Cég címe</h5>
                <label for="company_district">Kerület:</label>
                    <select class="form-control" id="company_district" name="company_district" >
                        <option value="0" selected disabled>Válasszon kerületet</option>
                        <?php
                        for ($i = 1; $i < 24; $i++) {
                            echo "<option value='$i'>$i.</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3 provider_form">
                    <label for="company_street" class="form-label">Közterület neve és típusa:</label>
                    <input type="text" class="form-control" id="company_street" name="company_street" >
                </div>

                <div class="mb-3 provider_form">
                    <label for="company_housenumber" class="form-label">Házszám (Lépcsőház/Emelet/Ajtó):</label>
                    <input type="text" class="form-control" id="company_housenumber" name="company_housenumber" >
                </div>

                <button type="submit" class="btn btn-primary">Regisztráció</button>

            </form>
        </div>
        <img src="/public/images/signIn_logo.png" alt="Jelentkezz be!" class="img-fluid mx-auto d-block signIn-logo m-4">
        <div class="container">
            <div class="row justify-content-center">
                <h3>Van már fiókod?</h3>

                <div>
                    <a class="d-flex justify-content-center" href="#">
                        <button class="btn btn-primary position-center col col-md-2 m-4" onclick="redirectToPage('/login')">Bejelentkezés</button>
                    </a>
                </div>

            </div>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>
