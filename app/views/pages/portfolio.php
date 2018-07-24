<?php require APPROOT . '/views/inc/header.php'; ?>


<section class="inner-wrap" id="inner-wrap">
    <?php $articles = $data['portfolio']; ?>

    <!-- Artikelliste erstellen +++++++++++++++++++++++++++++++++++++++ -->
    <?php foreach ($articles as $article) : ?> 

        <article class="content portfolio">
            
            <div class="crop-img">
                <img src="<?= URLROOT ?>/public/img/portfolio/<?= $article->img_link ?>" class="thumbnail auto-width" alt="<?= explode('.', $article->img_link)[0] ?>">
                <div class="img-text">
                    <h3 class="portfolio h3"><?= $article->headline ?></h3>
                    <p class="portfolio subhead"><i><?= $article->subhead ?></i></p>
                </div>
            </div>

            <p class="description"><?= $article->description ?></p>

            <!-- die id von a:href bekommt den Namen der Datei im Link -->
            <?php
                $filet = explode('/', $article->href);
                $count = count($filet) - 1;
                $datei = explode('.', $filet[$count]);
            ?>
            <!-- ______________________________________________ -->

            <a href="<?= $article->href ?>" id="<?= $datei[0] ?>" class="expand-link" target="_blank"></a>
        </article> <!-- ende .content -->
        
    <?php endforeach ?>
    <!-- ende Artikelliste _______________________________________ -->
</section> <!-- ende inner-wrap -->

<?php require APPROOT . '/views/inc/footer.php'; ?>

