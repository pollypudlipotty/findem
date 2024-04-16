<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

<div>
    <?php if (isset($message) && !empty($message)): ?>       

        <div class="alert alert-danger"><?php echo htmlentities($message); ?></div>

    <?php endif; ?>
</div>

<img id="registration-logo" src="/public/images/profilUpdate_logo.png" alt="Regisztráció" class="img-fluid mx-auto d-block">

<h2 class="text-center m-b-4 titles"><span>Profil adatok módosítása<span></h2>

<div class="row">
    <div class="col-3"></div>
    <div class="card m-4 profilUpdate col-6">
        <div id="updatePassword" class="container registrationBox ms-0">
            <h4 >Jelszó megváltoztatása</h4>
            <form action="/service_profile/updatePassword" method="POST">
                <div id="errorMessages"></div>
                <div class="mb-3">
                    <label for="oldPassword" class="form-label">Régi jelszó:</label>
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Új jelszó:</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                </div>
                <div class="mb-3">
                    <label for="newPasswordAgain" class="form-label">Új jelszó ismét:</label>
                    <input type="password" class="form-control" id="newPasswordAgain" name="newPasswordAgain">
                </div>
                <button type="submit" class="btn btn-primary mb-5" onclick="redirectToPage('/service_profile')">Mentés</button>
            </form>
        </div>

        <div>
            <h4>Szolgáltatás adatainak módosítása</h4>
            <form class="mt-3 me-3" action="/service_profile/updateService" method="POST">

                <label class="m-2" for="company_district">Kategória:</label>
                <select class="form-control mb-3 ms-2" id="service_category" name="service_category">
                    <?php foreach ($categories as $category): ?>
                        <?php if ($serviceData['service_category_id'] === $category['category_id']): ?>
                            <option value="<?= $category['category_id']; ?>"
                                    selected><?php echo $category['category_name']; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>

                <label for="company_name" class="form-label m-2">Cég neve:</label>
                <input type="text" class="form-control mb-3 ms-2" id="company_name" name="company_name"
                    value="<?= htmlentities($serviceData['service_name']); ?>">

                <label for="company_description" class="form-label m-2">Leírás:</label>
                <textarea class="form-control mb-3 ms-2" id="company_description" name="company_description"
                ><?php echo htmlentities($serviceData['service_description']); ?></textarea>

                <label for="company_district" class="m-2">Kerület:</label>
                <select class="form-control mb-3 ms-2" id="company_district" name="company_district">
                    <?php
                    for ($i = 1; $i < 24; $i++) {
                        if ($serviceData['service_district'] === $i) {
                            echo "<option value='$i' selected>$i.</option>";
                        } else {
                            echo "<option value='$i'>$i.</option>";
                        }
                    }
                    ?>
                </select>

                <label for="company_street" class="form-label -2">Közterület neve és típusa:</label>
                <input type="text" class="form-control mb-3 ms-2" id="company_street" name="company_street" value="<?= htmlentities($serviceData['service_address']); ?>">

                <label for="company_housenumber" class="form-label m-2">Házszám:</label>
                <input type="text" class="form-control mb-3 ms-2" id="company_housenumber" name="company_housenumber" value="<?= htmlentities($serviceData['service_housenumber']); ?>">
                
                <button class="btn btn-primary ms-2" onclick="redirectToPage('/service_profile')">Mentés</button>

            </form>
        </div>
    </div>
    <div class="col-3"></div>
</div>

<?php include 'inc/footer.php'; ?>

