<div class="hamburger">
    <a href="#open" id="open" class="show"></a>
    <a href="#close" id="close" class="hidden"></a>
</div>

<div class="nav-container">
        <nav>
            <ul class="nav-ul">
                <!-- schauen welcher Link die Klasse 'active' bekommt -->
                <?php
                    $url = '';
                    if (isset($_GET['url'])) {
                        $url = $_GET['url'];
                    }
                ?>
        
                <li class="<?= $url == '' ? 'active' : ''; ?>">
                        <a href="<?php echo URLROOT ?>" title="home">Home</a>
                </li>
                <li class="<?= $url == 'page/about' ? 'active' : '' ?>">
                    <a href="<?php echo URLROOT ?>/page/about" title="about">Über mich</a>
                </li>
                <li class="<?= $url == 'portfolio' ? 'active' : '' ?>">
                    <a href="<?php echo URLROOT ?>/portfolio" title="portfolio">Portfolio</a>
                </li>
                <li class="<?= $url == 'blog' ? 'active' : '' ?>">
                    <a href="<?php echo URLROOT ?>/blog" title="blog">Blog</a>
                </li>
                <li class="<?= $url == 'kontakt' ? 'active' : '' ?>">
                    <a href="<?php echo URLROOT ?>/kontakt" title="kontakt">Kontakt</a>
                </li>
                <li class="<?= $url == 'page/impressum' ? 'active' : '' ?>">
                    <a href="<?php echo URLROOT ?>/page/impressum" title="impressum">Impressum</a>
                </li>
            </ul>
        </nav>
        
        <div class="register-login">
            <ul class="clear">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="user-name">Hallo <?= $_SESSION['user_name'] ?></li>
                    <li><a href="<?php echo URLROOT ?>/user/logout" title="logout">Logout</a></li>
                <?php else : ?>
                    <li class="<?= $url == 'user/register' ? 'active' : '' ?>">
                        <a href="<?php echo URLROOT ?>/user/register" titel="register">Registrieren</a>
                    </li>
                    <li class="<?= $url == 'user/login' ? 'active' : '' ?>">
                        <a href="<?php echo URLROOT ?>/user/login" title="login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    
</div>
<!-- ende nav-container ___________________________________________________ -->