<?php require APPROOT . '/views/inc/header.php'; ?>


<section class="inner-wrap" id="inner-wrap">
    <?php $article = $data['article']; ?>

    <a href="<?= URLROOT ?>/blog" class="back-button">Zurück zum Blog</a>

    <article class="content">
        <div class="article-head">
            <h3><?= $article->title ?></h3>
            <p class="user-data clear">
                <span class="blog-author"><?= $article->userName ?></span>
                <?php if (isLoggedIn() && (getUserId() == $article->user_id)) : ?>
                    <span> Das bist du selbst!</span>
                <?php endif ?>
                <span class="post-created"><?= $article->postCreated ?></span>
            </p>
        </div> <!-- enee .article-head -->

        <!-- Beitragstext -->
        <p class="blog-article"><?= $article->body ?></p>
        <!-- ende Beitragstext -->

        <footer>
            <!-- optionale Buttons: Bearbeiten, Löschen -->
            <?php if (isLoggedIn() && (getUserId() == $article->user_id)) : ?>
                <div class="content button">
                    <a href="<?= URLROOT ?>/blog/edit/<?= $article->postId ?>">Beitrag editieren</a>
                </div>
                <div class="content delete button">
                    <form action="<?= URLROOT ?>/blog/delete/<?= $article->postId ?>" method="POST">
                        <input type="submit" value="Beitrag löschen" class="danger">
                    </form>
                </div>
            <?php endif ?>
        </footer>
    </article>
</section> <!-- ende inner-wrap -->


<?php require APPROOT . '/views/inc/footer.php'; ?>