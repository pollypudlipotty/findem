<?php include 'inc/header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include 'inc/' . $nav; ?>


<div>
    <?php if (isset($message) && !empty($message)): ?>
        <div class="alert alert-danger"><?php echo htmlentities($message); ?></div>
    <?php endif; ?>
   <div class="container registrationBox">
    <form action="/seeker_profile/updatePassword" method="POST">
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
        <button type="submit" class="btn btn-primary" onclick="redirectToPage('/seeker_profile')">Mentés</button>
    </form>
    </div>

<?php include 'inc/footer.php'; ?>