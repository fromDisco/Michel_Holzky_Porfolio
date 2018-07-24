<?php

/*
 * Basis-Controller
 * lädt die Models und Views
 */

class Controller {
    // Das entsprechende Model laden
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }  // ende function mode()

    // Die zugehöhrige View-Datei laden
    public function view($view, $data = []) {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php'; 
        }
        else {
            die('Leider ist das jetzt eine Sackgasse');
        }
    } // ende function view()
} // ende class Controller