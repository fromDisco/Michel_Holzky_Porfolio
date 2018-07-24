<?php

class Kontakt_controller extends Controller {

    public function __construct() {
        // $this->model liegt in Controller.php
        // und lädt das zugehörige Model
        // $this->kontaktModel = $this->model('Kontakt');
    } // ende function __construct ------------------

    
    public function index() {

        if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

            // Array bereinigen
            // INPUT_POST ruft alle POST-Variablen auf
            // FILTER_SANITIZE_STRING entfernt HTML-Tags 
            // und encodiert oder entfernt Special-Chars
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'head' => 'Kontakt',

                'name' => trim($_POST['name']),
                'name_err' => '',

                'email' => trim($_POST['email']),
                'email_err' => '',

                'message' => trim($_POST['message']),
                'message_err' => '',
            ];
            if (empty($data['name'])) {
                $data['name_err'] = 'Geben Sie bitte Ihren Namen an.';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Geben Sie bitte Ihre Mail-Adresse an.';
            }
        
            if (empty($data['message'])) {
                $data['message_err'] = 'Geben sie bitte Ihre Nachricht ein.';
            }
        
            if (empty($data['name_err']) && empty($data['message_err'])) {
                // Wenn HTML Mail verschickt wird, müssen Benutzereingaben
                // wie Name und Nachricht mit htmlspecialchars oder
                // htmlentities bereinigt werden!!!
                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];
                $to = "doc.snuggles@web.de";
                $subject = "Nachricht von: " . $name . "; Mail-Adresse: " . $email;
                $body = $name . " schreibt:/n" . $message;
                $data['post'] = $_POST;

                if (mail($to, $subject, $body)) {
                    redirect('blog');
                }
                else {
                    // Mailversand nicht geglückt
                    $this->view('pages/kontakt', $data);
                }
            }
            else {
                // Es gibt Fehlermeldungen. Mit Fehlermeldungen zurück zum Formular
                $this->view('pages/kontakt', $data);
            }
        }
        else {
            $data = [
                'head' => 'Kontakt',

                'name' => '',
                'name_err' => '',

                'email' => '',
                'email_err' => '',

                'email' => '',
                'email_err' => '',

                'message' => '',
                'message_err' => '',
            ];
            $this->view('pages/kontakt', $data);
        }
    } // ende index() ---------------------------------------------------------


} // ende Kontakt_controller --------------------------------------------------