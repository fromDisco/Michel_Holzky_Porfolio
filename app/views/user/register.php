<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="inner-wrap" id="inner-wrap">
    <form action="<?php echo URLROOT ?>/user/register" method="POST">
        <fieldset>
            <legend>Register</legend>
            <div class="input-wrap">
                <label for="name">Name <sup>*</sup></label>
                <input type="text" id="name" name="name" value="<?= trim($data['name']) ?>" class="<?= (!empty($data['name_err']) ? "invalid" : "") ?> formfield" autofocus>
                <span class="invalid-feedback"><?= $data['name_err'] ?></span>
            </div>

            <div class="input-wrap">
                <label for="email">E-Mail <sup>*</sup></label>
                <input type="email" id="email" name="email" value="<?= trim($data['email']) ?>" class="<?= (!empty($data['email_err']) ? "invalid" : "") ?> formfield">
                <span class="invalid-feedback"><?= $data['email_err'] ?></span>
            </div>
            
            <div class="input-wrap">
                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" class="<?= (!empty($data['password_err']) ? "invalid" : "") ?> formfield">
                <span class="invalid-feedback"><?= $data['password_err'] ?></span>
            </div>
            
            <div class="input-wrap">
                <label for="confirm-password">Passwortbestätigung</label>
                <input type="password" id="confirm-password" name="confirm-password" class="<?= (!empty($data['confirm_password_err']) ? "invalid" : "") ?> formfield">
                <span class="invalid-feedback"><?= $data['confirm_password_err'] ?></span>
            </div>
        </fieldset>

        <div class="content button">
            <input type="submit" value="Registrieren" class="submit">
        </div>
    </form>
    <div class="href-button">
        <a href="<?= URLROOT ?>/user/login" class="href-button">Sie haben schon einen Account? Loggen Sie sich ein.</a>
    </div>
</div> <!-- ende .inner-wrap -->

<?php require APPROOT . '/views/inc/footer.php'; ?>
