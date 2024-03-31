<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

<div>
    <?php if (isset($message) && !empty($message)): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="/seeker_profile/updatePassword" method="POST">
        <label for="oldPassword">Régi jelszó:</label>
        <input type="password" name="oldPassword">
        <label for="newPassword">Új jelszó</label>
        <input type="password" name="newPassword">
        <button>Mentés</button>
    </form>
</div>
