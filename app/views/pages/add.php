<?php require APPROOT . '/views/inc/header.php'; ?>


<section class="inner-wrap" id="inner-wrap">
    <a href="<?= URLROOT ?>/blog" class="back-button">Zurück zum Blog</a>
    <form action="<?php echo URLROOT ?>/blog/add" method="POST">
        <fieldset>
            <legend>Beitrag verfassen</legend>

            <div class="input-wrap">
                <label for="title">Überschrift</label>
                <input type="text" id="title" name="title" value="<?= trim($data['title']) ?>" class="<?= (!empty($data['title_err']) ? "invalid" : "") ?> formfield">
                <span class="invalid-feedback"><?= $data['title_err'] ?></span>
            </div>

            
            <div class="input-wrap">
                <label for="body">Ihr Text</label>
                <textarea name="body" id="body" cols="30" rows="10" class="<?= (!empty($data['body_err']) ? "invalid" : "") ?> formfield"><?= $data['body'] ?></textarea>
                <span class="invalid-feedback"><?= $data['body_err'] ?></span>
            </div>
            
        </fieldset>

        <div class="content button">
            <input type="submit" value="Beitrag hinzufügen" class="submit">
        </div>
    </form>
</section> <!-- ende .inner-wrap -->

<?php require APPROOT . '/views/inc/footer.php'; ?>
