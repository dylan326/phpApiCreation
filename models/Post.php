<?php

class Post {
    //DB stuff

    private $conn;
    private $table = 'posts';

    //post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;


    //constroctor with db;

    public function __construct($db)
    {
        $this->conn = $db;

    }

    public function read()
    { //create query

        $query = 'SELECT categories.name, posts.id, posts.category_id, posts.title, posts.body, posts.author, posts.created_at FROM '.$this->table.' LEFT JOIN categories ON posts.category_id = categories.id ORDER BY posts.created_at DESC';

        //prepared statement

        $stmt = $this->conn->prepare($query);
        //execute query

        $stmt->execute();

        return $stmt;

    }
}