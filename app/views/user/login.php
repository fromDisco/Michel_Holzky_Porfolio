<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="inner-wrap" id="inner-wrap">
    <form action="<?php echo URLROOT ?>/user/login" method="POST">
        <fieldset>
            <legend>Login</legend>

            <div class="formfield-wrap">
                <label for="email">E-Mail <sup>*</sup></label>
                <input type="email" id="email" name="email" value="<?= trim($data['email']) ?>" class="<?= (!empty($data['email_err']) ? "invalid" : "") ?> formfield" autofocus>
                <span class="invalid-feedback"><?= $data['email_err'] ?></span>
            </div>
            
            <div class="formfield-wrap">
                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" class="<?= (!empty($data['password_err']) ? "invalid" : "") ?> formfield">
                <span class="invalid-feedback"><?= $data['password_err'] ?></span>
            </div>
            
        </fieldset>

        <div class="content button">
            <input type="submit" value="Login" class="submit">
        </div>
    </form>

    <div class="href-button">
        <a href="<?= URLROOT ?>/user/register">Sie haben noch keinen Account? Registrieren Sie sich.</a>
    </div>
</div> <!-- ende .inner-wrap -->

<?php require APPROOT . '/views/inc/footer.php'; ?>
