<?php

class Blog_post {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }


    // getPosts +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getPosts() {
        // $this->db->query('SELECT * FROM posts');
        // LEFT(P.body, 200) as body begrenzt den ausgegebenen Inhalt auf 200 Zeichen.
        $this->db->query('SELECT P.id as postId, P.title, P.user_id, LEFT(P.body, 200) as body,    
                         P.created_at as postCreated, U.name as userName 
                         FROM posts P
                         JOIN users U ON P.user_id = U.id
                         ORDER BY P.created_at DESC
                        ');

        if ($this->db->resultSet()) {
            return $this->db->resultSet();
        }
        else {
            return false;
        }
    } // ende getPosts --------------------------------------------------------


    // getPostById ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getPostById($id) {

        $this->db->query('SELECT P.id as postId, P.title, P.user_id, P.body as body,    
                         P.created_at as postCreated, U.name as userName 
                         FROM posts P 
                         JOIN users U ON P.user_id = U.id
                         WHERE P.id = :id
                        ');
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;

    } // getPostById ----------------------------------------------------------


    // addPost ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function addPost($data) {
        // $this->db->query('SELECT * FROM posts');
        $this->db->query('INSERT INTO posts (id, user_id, title, body, created_at)
                         VALUES (NULL, :user_id, :title, :body, CURRENT_TIMESTAMP)
                        ');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    } // ende addPost ---------------------------------------------------------
    
    
    
    // storePost ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function updatePost($data) {
        $this->db->query('UPDATE posts SET title = :title, body = :body 
                         WHERE id = :id
                        ');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':id', $data['id']);
        
        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
        
    } // ende storePost ---------------------------------------------------------
    
    
    // deletePost ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function deletePost($id) {
        $this->db->query('DELETE FROM posts WHERE posts.id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    } // ende deletePost ---------------------------------------------------------
} // ende user