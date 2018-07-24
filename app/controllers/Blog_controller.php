<?php

class Blog_controller extends Controller {

    // CONSTRUCT ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function __construct() {
        if(!isLoggedIn()) {
            redirect('user/login');
        }
        $this->postModel = $this->model('Blog_post');
    } // ende construct -------------------------------------------------------


    // INDEX ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function index() {
        $articles = $this->postModel->getPosts();

        $data = [
            'head' => 'Blog',
            'blog' => $articles
        ];
        $this->view('pages/blog', $data);
    } // ende index -----------------------------------------------------------
    
    
    // add ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function add() {
        // $article = $this->postModel->addPost();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // die eingehenden POST-Daten aus dem Formular bereinigen
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'head' => 'Blog',

                'title' => trim($_POST['title']),
                'title_err' => '',

                'user_id' => $_SESSION['user_id'],
    
                'body' => trim($_POST['body']),
                'body_err' => ''
            ];

            // Validierung ++++++++++++++++++++++++++++++++++++++++++++++++++++
            if (empty($_POST['title'])) {
                $data['title_err'] = 'Bitte tragen sie eine Überschrift ein.';
            }
            if (empty($_POST['body'])) {
                $data['body_err'] = 'Bitte tragen sie einen Text ein.';
            }

            // die Daten eintragen oder bei Fehler erneut zum Formular weiterleiten
            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postModel->addPost($data)) {
                    redirect('blog');
                }
                else {
                    die('Die Daten konnten nicht eingetragen werden');
                }
            } 
            else {
                // Formular mit Fehlermeldungen neu laden
                $this->view('pages/add', $data);
            }
            // ende Validierung -----------------------------------------------
        } 
        else {
            // Wenn die Request-Methode nicht POST ist
            $data = [
                'head' => 'Blog',
                'title' => '',
                'title_err' => '',
    
                'body' => '',
                'body_err' => ''
            ];
        } // ende if ($_SERVER['REQUEST_METHOD'] == 'POST')

        $this->view('pages/add', $data);
    } // ende add() -----------------------------------------------------------
    
    
    // edit +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function edit($id) {
        $post = $this->postModel->getPostById($id);
        
        // verhindert, dass unberechtigte Nutzer den Beitrag ändern können
        if ($post->user_id != $_SESSION['user_id']) {
            redirect('blog');
        }
                
        $data = [
            'head' => 'Blog',
            'editArticle' => $post,

            'title' => '',
            'title_err' => '',

            'body' => '',
            'body_err' => ''
        ];
        $this->view('pages/edit', $data);
    } // ende edit() -----------------------------------------------------------
    
    
    // store +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function update($id) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // verhindert, dass unberechtigte Nutzer den Beitrag ändern können
            $post = $this->postModel->getPostById($_POST['id']);
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('blog');
            }
            // die eingehenden POST-Daten aus dem Formular bereinigen
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'head' => 'Blog',
                // 'editArticle' => $edit,

                'user_id' => $_SESSION['user_id'],
                'id' => $id,
                // 'id' => $_POST['id'],

                'title' => trim($_POST['title']),
                'title_err' => '',


                'body' => trim($_POST['body']),
                'body_err' => ''
            ];

            // Validierung ++++++++++++++++++++++++++++++++++++++++++++++++++++
            if (empty($_POST['title'])) {
                $data['title_err'] = 'Dein Beitrag braucht eine Überschrift.';
            }
            if (empty($_POST['body'])) {
                $data['body_err'] = 'Dein Beitrag braucht einen Text.';
            }

            // die Daten eintragen oder bei Fehler erneut zum Formular weiterleiten
            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postModel->updatePost($data)) {
                    redirect('blog');
                }
                else {
                    die('Die Daten konnten nicht eingetragen werden');
                }
            } 
            else {
                // Formular mit Fehlermeldungen neu laden
                $this->view('pages/edit', $data);
            }
            // ende Validierung -----------------------------------------------

        }
        else {
            // Wenn die Request-Methode nicht POST ist
            $data = [
                'head' => 'Blog',
                'editArticle' => $edit,

                'title' => '',
                'title_err' => '',
    
                'body' => '',
                'body_err' => ''
            ];
        } // ende if ($_SERVER['REQUEST_METHOD'] == 'POST')
        
    } // ende edit() -----------------------------------------------------------


    // show +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function show($id) {
        $post = $this->postModel->getPostById($id);
        
        $data = [
            'head' => 'Blog',
            'article' => $post
        ];
        $this->view('pages/show', $data);
    } // ende show ------------------------------------------------------------
    
    
    // show +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function delete($id) {
        
        // verhindert, dass unberechtigte Nutzer den Beitrag ändern können
        $post = $this->postModel->getPostById($_POST['id']);
        if ($post->user_id != $_SESSION['user_id']
        &&
        $_SERVER['REQUEST_METHOD'] == 'POST' 
        ) {
            if ($this->postModel->deletePost($id)) {
                redirect('blog');
            }
            else {
                
            }
        }
        else {
            redirect('blog');
        }
    } // ende show ------------------------------------------------------------

} // class Blog_controller ----------------------------------------------------