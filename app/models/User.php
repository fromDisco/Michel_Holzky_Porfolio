<?php

///////////////////////////////////////////////////////////////////////////////
// MODEL
///////////////////////////////////////////////////////////////////////////////

class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Nutzer registrieren ++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function register($data) {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        
        // Die Werte an die VALUES der Query binden
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        
        if ($this->db->execute()) {
            return true;
        } 
        else {
            return false;
        }
    } // function register ----------------------------------------------------

    
    // Nutzer über Email-Adresse in DB suchen +++++++++++++++++++++++++++++++++
    public function getUserByEmail($email) {
        // Methoden aus Database.php
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        // Die passenden Daten aus der Datenbank anfordern
        $row = $this->db->single();
        
        // Wenn ein Eintrag mit der gleichen Email-Adresse gefunden wurde: ...
        // if ($row != false) {
        //     return true;
        // } else {
        //     return false;
        // }

        // ALTERNATIV DAZU: Wie im Kurs vorgschlagen ++++++++++++++++++++++++++
        // // Anzahl der gefunden Datensätze zählen
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        // ende alternative ---------------------------------------------------
    } // ende getUserByEmail() ------------------------------------------------


    // Nutzer einloggen +++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        $hashed_password = $row->password;

        if (password_verify($password, $hashed_password)) {
            return $row;
        }
        else {
            return false;
        }

    } // ende nuter einloggen -------------------------------------------------
}