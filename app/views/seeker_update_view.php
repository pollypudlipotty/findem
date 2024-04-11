<?php include 'inc/header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include 'inc/' . $nav; ?>

<div>
    <?php if (isset($message) && !empty($message)): ?>
        <div class="alert alert-danger"><?php echo htmlentities($message); ?></div>
    <?php endif; ?>
    <form action="/seeker_profile/updatePassword" method="POST">
        <label for="oldPassword">Régi jelszó:</label>
        <input type="password" name="oldPassword">
        <label for="newPassword">Új jelszó</label>
        <input type="password" name="newPassword">
        <label for="newPasswordAgain">Új jelszó ismét</label>
        <input type="password" name="newPasswordAgain">
        <button>Mentés</button>
    </form>
</div>
