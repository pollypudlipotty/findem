<?php include 'inc/header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include 'inc/' . $nav; ?>

    <div class="container">
        <!--Új időpont feltöltése-->

        
        <img id="registration-logo" src="public/images/newAppointment_logo.png" alt="Új időpont feltöltése"
             class="img-fluid mx-auto d-block">

        <div class="row">
            <h2 class="text-center m-b-4 titles"><span>Új időpont feltöltése<span></h2>

        </div>

        <div class="container registrationBox">
            <form action="/registration/userRegistration" id="registrationForm" method="POST">
                <div id="errorMessages"></div>

                <?php if (isset($message) && !empty($message)): ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>


                <div class="mb-3">
                    <label for="" class="form-label">Szolgáltatás megnevezése:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Időpont:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Helyszín:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Megjegyzés:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
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
                    <label for="company_housenumber" class="form-label">Házszám:</label>
                    <input type="text" class="form-control" id="company_housenumber" name="company_housenumber" >
                </div>

                <button type="submit" class="btn btn-primary" onclick="">Időpont feltöltése</button>

            </form>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>
