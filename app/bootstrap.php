<?php
// Konfiguration laden (Variablen)
require_once 'config/config.php';

// Helpers.php laden
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

// Bibliotheken laden
// require_once 'lib/Core.php';
// require_once 'lib/Controller.php';
// require_once 'lib/Database.php';


############################################
// Autoload Core Libraries
// ersetz das Einbinden der einzelnen Bibliotheken
spl_autoload_register(function($className) {
    require_once 'lib/' . $className . '.php';
});
# ------------------------------------------