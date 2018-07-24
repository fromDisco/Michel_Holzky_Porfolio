<?php

class GetAjaxContent {
    private $db;

    public function __construct() {
        $this->db = new Database;
        // return index();
    }

    // getAjaxContent +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function index() {
        $imgLink = $_REQUEST['value'];

        $this->db->query('SELECT description From portfolio
                        WHERE img_link = :img_link
                        ');

        $this->db->bind(':img_link', $imgLink);
        $row = $this->db->single();

        return $row;
    }
    // ende getAjaxContent -----------------------------------------------------.
}

