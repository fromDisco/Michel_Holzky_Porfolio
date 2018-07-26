<!DOCTYPE html>
<html lang="de">
<head>

    <meta name="description" content="Das ist ein Framework, dass auf einem OOP und MVC-Tutorial von TraversyMedia basiert">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i|Ubuntu:500,500i,700,700i" rel="stylesheet"> 
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/gradient.css">

    <script src="<?php echo URLROOT; ?>/public/js/lib.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/gradient.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/main.js"></script>
    <title><?php echo SITENAME; ?></title>
</head>
<body class="clear">
    

    <!-- Der Wrapper soll auf der Startseite anders gestaltet werden -->
    <?php
    if (trim($_SERVER['REQUEST_URI'], "/") == 'Michel_Holzky_Portfolio-WIP') {
        echo '<div class="wrapper index">';
    }
    else {
        echo '<div class="wrapper">';
    }
    ?>


    <header class="head clear">
        <h1><?php echo $data['head']; ?></h1>
        <?php if (!isset($data['home'])) : ?>
            <h2><a href="<?= URLROOT ?>">Michel Holzky</a></h2>
        <?php endif ?>
    </header>


    <!-- Navigation +++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <?php require 'navbar.php'; ?>
    <!-- ende Navigation __________________________________________________ -->