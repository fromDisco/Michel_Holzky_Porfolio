<?php

/*
 * Core-Klasse der App
 * Erstellt URL & läd die Controller
 * URL-Formatierung - /controller/method/params
 */

class Core {

    // Falls es die angeforderte URL nicht gibt ist 'Pages' der Standartwert
    protected $currentController = 'Page_controller';
    protected $currentMethod = 'index';
    protected $params = [];


    // #################################################################
    // CONSTRUCT #######################################################
    public function __construct() {
        // bekommt aus der GET-Anfrage die URL als Array zurück. 
        // Index [0] = Datei
        // Index [1] = Methode
        // Index [2] = Wert
        $url = $this->getUrl();
        
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '_controller.php')) {
            $this->currentController = ucwords($url[0] . '_controller');
            // wird gelöscht, damit nachher nur noch die 'params' im Array stehen
            unset($url[0]);
        } 
        // Den Controller anfordern
        require_once '../app/controllers/' . $this->currentController . '.php';
        // Eine neue Instanz von der Controllerklasse erstellen
        $this->currentController = new $this->currentController;
        
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // Hier wird der entsprechende Controller 
        // mit der zugehörigen Methode und dem Parametern aufgerufen
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        // --------------------------------------------------------------------

    } // ende CONSTRUCT -------------------------------------------------
    // ------------------------------------------------------------------

    
    public function getUrl() {
        if (isset($_GET['url'])) {
            // rtrim entfernt unerwünschte Zeichen am Anfang und am Ende des Strings
            $url = rtrim($_GET['url'], '/');
            // SANITIZE BEREINIGT DIE URL VON UNERWÜNSCHTEN ZEICHEN
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
            return $url;
        }
    }
} 
