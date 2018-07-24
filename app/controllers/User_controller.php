<?php

class User_controller extends Controller {

    public function __construct() {
        // $this->model liegt in Controller.php
        // und lädt das zugehörige Model
        $this->userModel = $this->model('User');
    } // ende function __construct --------------------------------------------


    // ANFANG REGISTER ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function register() {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Array bereinigen
            // INPUT_POST ruft alle POST-Variablen auf
            // FILTER_SANITIZE_STRING entfernt HTML-Tags 
            // und encodiert oder entfernt Special-Chars
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Datenarray für view befüllen
            $data = [
                'head' => 'Registrieren',

                'name' => trim($_POST['name']),
                'name_err' => '',

                'email' => trim($_POST['email']),
                'email_err' => '',
                
                'password' => trim($_POST['password']),
                'password_err' => '',

                'confirm_password' => trim($_POST['confirm-password']),
                'confirm_password_err' => '',

                'title' => 'Register'
            ];

            // Namen-Validierung
            if (empty($data['name'])) {
                $data['name_err'] = "Bitte geben sie Ihren Namen an.";
            }
            // Email-Validierung
            if (empty($data['email'])) {
                $data['email_err'] = "Bitte geben sie eine Email-Adresse an.";
            } 
            elseif ($this->userModel->getUserByEmail($data['email'])) {
                $data['email_err'] = "Die Email-Adresse ist schon vergeben.";
            }
            
            // Passwort-Validierung
            if (empty($data['password'])) {
                $data['password_err'] = "Bitte geben sie ein Passwort an.";
            } 
            elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Passwort muss mindestens 6 Zeichen lang sein';
            }
            
            // Passwort-Validierung
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "Bitte wiederholen Sie das Passwort.";
            } 
            elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = "Die beiden Passwörter stimmen ncht überein.";
            }
            
            // Kontrollieren ob es Fehler gibt
            if (empty($data['name_err']) &&
                empty($data['email_err']) &&
                empty($data['password_err']) &&
                empty($data['confirm_password_err'])
            ) {
                // Passwort hashen
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Nutzer registrieren
                if ($this->userModel->register($data)) {
                    flash('register_success', 'Du bist registriert und kannst dich nun einloggen.');
                    redirect('user/login');
                } 
                else {
                    die('Da ist irgendwas falsch gelaufen');
                }
            }
            else {
                // Das Formular mit den Fehlern anzeigen
                $this->view('user/register', $data);
            }
        }
        else {
            // Datenarray anlegen
            $data = [
                'head' => 'Registrieren',

                'name' => '',
                'name_err' => '',

                'email' => '',
                'email_err' => '',
                
                'password' => '',
                'password_err' => '',

                'confirm_password' => '',
                'confirm_password_err' => '',

                'title' => 'Register'
            ];
            // Das Formular laden
            $this->view('user/register', $data);
        } // ende if-else
    } // ende function register -----------------------------------------------
    // ende register ----------------------------------------------------------


    // ANFANG LOGIN +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'email' => trim($_POST['email']),
                'email_err' => '',

                'password' => trim($_POST['password']),
                'password_err' => '',

                'head' => 'Login'
            ];

            // Formular validieren
            if (empty($data['email'])) {
                $data['email_err'] = 'Bitte E-Mail-Adresse angeben';
            }
            // Für Login: nach user/email suchen
            elseif ($this->userModel->getUserByEmail($data['email'])) {
                // Benutzer gefunden
                /////////////////////////////////////////////////
            } 
            else {
                // Benutzer nicht gefunden
                $data['email_err'] = 'Benutzer nicht gefunden';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Das Password muss angegeben werden';
            }
            
            // Kontrollieren ob es Fehlermeldungen gibt, wenn nicht LOGIN +++++
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // user einloggen
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // SESSION starten
                    $this->createUserSession($loggedInUser);
                }
                else {
                    // Login gescheitert
                    $data['password_err'] = 'Das Passwort ist falsch';
                    $this->view('user/login', $data);
                }
            }
            else {
                // Dokument mit Fehlermeldungen laden
                $this->view('user/login', $data);
            } // ende login ---------------------------------------------------
        }
        // Wenn die REQUEST_METHOD nicht 'POST' ist
        // den $data-Array leer lassen und wieder zum Login-Formular weiterleiten
        else {
            $data = [
                'email' => '',
                'email_err' => '',

                'password' => '',
                'password_err' => '',

                'head' => 'Login'
            ];

            $this->view('user/login', $data);
        } // ende else
    } // ende function login()
    // ende login -------------------------------------------------------------

    
    // LOGOUT +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('');
    } // ende logout ----------------------------------------------------------


    // BENUTZER EINLOGGEN +++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function createUserSession($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser->id;
        $_SESSION['user_email'] = $loggedInUser->email;
        $_SESSION['user_name'] = $loggedInUser->name;
        redirect('blog');
    } // ende einloggen -------------------------------------------------------

} // ende class User ----------------------------------------------------------