<?php require APPROOT . '/views/inc/header.php'; ?>


<!-- falls die Speicherung des Dokuments wegen Fehlern bei der Eingabe
abgebrochen wird, wird wie hierher zurückgeleitet. Der Datenarray 
zur befüllung des Dokuments ist nur beim ersten aufruf nötig. Danach
wird der Inhalt aus der store-funktion weitergegeben -->
<?php 
    if (isset($data['editArticle'])) {
        $article = $data['editArticle']; 
    }
    ?>
<section class="inner-wrap" id="inner-wrap">
    <a href="<?= URLROOT ?>/blog" class="back-button">Zurück zum Blog</a>
    <form action="<?= URLROOT ?>/blog/update/<?= $article->postId ?>" method="POST">
        <fieldset>
            <legend>Beitrag ändern</legend>

            <div class="formfield-wrap">
                <label for="title">Überschrift</label>
                <input type="text" id="title" name="title" value="<?= trim($article->title) ?>" class="<?= (!empty($data['title_err']) ? "invalid" : "") ?> formfield" autofocus>
                <span class="invalid-feedback"><?= $data['title_err'] ?></span>
            </div>
            
            <div class="formfield-wrap">
                <label for="body">Ihr Text</label>
                <textarea name="body" id="body" cols="30" rows="10" class="<?= (!empty($data['body_err']) ? "invalid" : "") ?> formfield"><?= $article->body ?></textarea>
                <span class="invalid-feedback"><?= $data['body_err'] ?></span>
            </div>

            <!-- <input type="hidden" name="id" value="<?= $article->postId ?>"> -->
            
        </fieldset>

        <div class="content button">
            <input type="submit" value="Beitrag ändern" class="submit">
        </div>
    </form>
</section> <!-- ende .inner-wrap -->

<?php require APPROOT . '/views/inc/footer.php'; ?>
