<?php require APPROOT . '/views/inc/header.php'; ?>


<section class="inner-wrap" id="inner-wrap">
    <form method="POST" action="<?= URLROOT ?>/kontakt"> 
        <fieldset>
            <legend>Ihre Daten</legend>
            <!-- Name -->
            <div class="input-wrap">
                <label for="name">Ihr Name</label>
                <input type="text" name="name" id="name" class="<?= (!empty($data['name_err']) ? "invalid" : "") ?> formfield"autofocus>
                <span class="invalid-feedback"><?= $data['name_err'] ?></span>
            </div>

            <!-- email -->
            <div class="input-wrap">
                <label for="email">Ihre Mail-Adresse</label>
                <input type="email" id="email" name="email" value="<?= trim($data['email']) ?>" class="<?= (!empty($data['email_err']) ? "invalid" : "") ?> formfield">
                <span class="invalid-feedback"><?= $data['email_err'] ?></span>
            </div>


            <!-- Nachricht -->
            <div class="input-wrap">
                <label for="message">Ihre Nachricht</label>
                <textarea name="message" id="message" class="<?= (!empty($data['message_err']) ? "invalid" : "") ?> formfield"></textarea>
                <span class="invalid-feedback"><?= $data['message_err'] ?></span>
            </div>
        </fieldset>
            <!-- Submit Button -->
        <div class="content button">
            <input type="submit" class="submit" value="Daten absenden">
        </div>
    </form>
</section> <!-- ende .inner-wrap -->


<?php require APPROOT . '/views/inc/footer.php'; ?>


