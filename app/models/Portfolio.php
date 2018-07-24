<?php

class Portfolio {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // getPosts +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getPosts() {
        // $this->db->query('SELECT * FROM posts');
        $this->db->query('SELECT * FROM portfolio
                         ORDER BY created_at DESC
                        ');

        if ($this->db->resultSet()) {
            return $this->db->resultSet();
        }
        else {
            return false;
        }
    } // ende getPosts() ------------------------------------------------------

} 

