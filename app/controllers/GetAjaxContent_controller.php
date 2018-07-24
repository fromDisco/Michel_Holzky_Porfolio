<?php

class Portfolio_controller extends Controller {

    // CONSTRUCT ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function __construct() {
        $this->ajaxModel = $this->model('GetAjaxContent');
    } // ende construct -------------------------------------------------------
    
    // INDEX ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function index() {
      
        $articles = $this->portfolioModel->index();

        return $articles;
        // $data = [
        //     'title' => 'Portfolio',
        //     'portfolio' => $articles
        // ];
        // $this->view('pages/portfolio', $data);
    } // ende index -----------------------------------------------------------
}