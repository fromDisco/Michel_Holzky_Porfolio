<?php

class Portfolio_controller extends Controller {

    // CONSTRUCT ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function __construct() {
        $this->portfolioModel = $this->model('Portfolio');
    } // ende construct -------------------------------------------------------
    
    // INDEX ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function index() {
        $articles = $this->portfolioModel->getPosts();

        $data = [
            'head' => 'Portfolio',
            'portfolio' => $articles
        ];
        $this->view('pages/portfolio', $data);
    } // ende index -----------------------------------------------------------
}