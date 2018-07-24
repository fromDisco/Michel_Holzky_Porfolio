<?php

// Variablen und Konstanten anlegen

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'michel_holzky_portfolio');


define('APPROOT', dirname(dirname(__FILE__)));

// URLROOT selbst anlegen
define('URLROOT', 'http://localhost/Michel_Holzky_Portfolio-WIP');

// SITENAME selbst anlegen
define('SITENAME', 'Michel Holzky - Portfolio');


// For security reasons, allow http-cookies only
// ini_set('session.cookie_httponly', '1');
// session_start();