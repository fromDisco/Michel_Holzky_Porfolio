
<div class="nav-container">
    <div class="hamburger">
        <a href="#open" id="open" class="show"></a>
        <a href="#close" id="close" class="hidden"></a>
    </div>
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
                    <a href="<?php echo URLROOT ?>">Home</a>
            </li>
            <li class="<?= $url == 'page/about' ? 'active' : '' ?>">
                <a href="<?php echo URLROOT ?>/page/about">Über mich</a>
            </li>
            <li class="<?= $url == 'portfolio' ? 'active' : '' ?>">
                <a href="<?php echo URLROOT ?>/portfolio">Portfolio</a>
            </li>
            <li class="<?= $url == 'blog' ? 'active' : '' ?>">
                <a href="<?php echo URLROOT ?>/blog">Blog</a>
            </li>
            <li class="<?= $url == 'kontakt' ? 'active' : '' ?>">
                <a href="<?php echo URLROOT ?>/kontakt">Kontakt</a>
            </li>
            <li class="<?= $url == 'page/impressum' ? 'active' : '' ?>">
                <a href="<?php echo URLROOT ?>/page/impressum">Impressum</a>
            </li>
        </ul>
    </nav>
    
    
    <div class="register-login">
        <ul class="clear">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li class="user-name">Hallo <?= $_SESSION['user_name'] ?></li>
                <li><a href="<?php echo URLROOT ?>/user/logout">Logout</a></li>
            <?php else : ?>
                <li><a href="<?php echo URLROOT ?>/user/register">Registrieren</a></li>
                <li><a href="<?php echo URLROOT ?>/user/login">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
