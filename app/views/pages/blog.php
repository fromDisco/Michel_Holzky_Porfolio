<?php require APPROOT . '/views/inc/header.php'; ?>


<section class="inner-wrap" id="inner-wrap">
    <?php $articles = $data['blog']; ?>

    <!-- Artikelliste erstellen +++++++++++++++++++++++++++++++++++++++ -->
    <?php foreach ($articles as $article) : ?> 

        <article class="article content space-left">
            <div class="article-head">
                <h3><?= $article->title ?></h3>
                <p class="user-data clear">
                    <span class="blog-author"><?= $article->userName ?></span>
                    <?php if (isLoggedIn() && (getUserId() == $article->user_id)) : ?>
                        <span> Das bist du selbst!</span>
                    <?php endif ?>
                    <span class="post-created"><?= $article->postCreated ?></span>
                </p>
            </div> <!-- ende .article-head -->
            <p class="blog-article"><?= $article->body ?></p>

            <div class="show-more"> <!-- Link: den ganzen Beitrag lesen -->
                <a href="<?= URLROOT ?>/blog/show/<?= $article->postId ?>">Den ganzen Artikel zeigen</a>
            </div>
        </article> <!-- ende .content -->

    <?php endforeach ?>
    <!-- ende Artikelliste _______________________________________ -->

    <!-- Beitrag hinzufügen -->
    <footer class="content button">
        <a href="<?= URLROOT ?>/blog/add" class="add-article">
            Beitrag hinzufügen
        </a>
    </footer>
</section> <!-- ende .inner-wrap -->


<?php require APPROOT . '/views/inc/footer.php'; ?>