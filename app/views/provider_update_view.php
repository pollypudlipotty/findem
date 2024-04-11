<?php include 'inc/header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include 'inc/' . $nav; ?>

<div>
    <?php if (isset($message) && !empty($message)): ?>
        <div class="alert alert-danger"><?php echo htmlentities($message); ?></div>
    <?php endif; ?>
</div>


<div>
    <form action="/service_profile/updatePassword" method="POST">
        <label for="oldPassword">Régi jelszó:</label>
        <input type="password" name="oldPassword">
        <label for="newPassword">Új jelszó</label>
        <input type="password" name="newPassword">
        <label for="newPasswordAgain">Új jelszó ismét</label>
        <input type="password" name="newPasswordAgain">
        <button>Mentés</button>
    </form>
</div>

<div>
    <form action="/service_profile/updateService" method="POST">

        <label for="company_district">Kategória:</label>
        <select class="form-control" id="service_category" name="service_category">
            <?php foreach ($categories as $category): ?>
                <?php if ($serviceData['service_category_id'] === $category['category_id']): ?>
                    <option value="<?= $category['category_id']; ?>"
                            selected><?php echo $category['category_name']; ?></option>
                <?php else: ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <label for="company_name" class="form-label">Cég neve:</label>
        <input type="text" class="form-control" id="company_name" name="company_name"
               value="<?= htmlentities($serviceData['service_name']); ?>">

        <label for="company_description" class="form-label">Leírás:</label>
        <textarea class="form-control" id="company_description" name="company_description"
        ><?php echo htmlentities($serviceData['service_description']); ?></textarea>

        <label for="company_district">Kerület:</label>
        <select class="form-control" id="company_district" name="company_district">
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

        <label for="company_street" class="form-label">Közterület neve és típusa:</label>
        <input type="text" class="form-control" id="company_street" name="company_street" value="<?= htmlentities($serviceData['service_address']); ?>">

         <label for="company_housenumber" class="form-label">Házszám:</label>
        <input type="text" class="form-control" id="company_housenumber" name="company_housenumber" value="<?= htmlentities($serviceData['service_housenumber']); ?>">

        <button>Mentés</button>
    </form>
</div>
