<?php

class Page_controller extends Controller {
    public function __construct() {

    }

    public function index() {
        $data = [
            'head' => 'Michel Holzky',
            'home' => 'hide'
        ];
        $this->view('pages/index', $data);
    }
    
    public function about() {
        $data = ['head' => 'About'];
        $this->view('pages/about', $data);
    }

    public function impressum() {
        $data = ['head' => 'Impressum'];
        $this->view('pages/impressum', $data);
    }
}