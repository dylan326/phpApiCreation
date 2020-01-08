<?php

class Category {
    //DB stuff

    private $conn;
    private $table = 'categories';

    //post properties
    public $id;
    public $name;
    public $created_at;


    //constroctor with db;

    public function __construct($db)
    {
        $this->conn = $db;

    }

    public function read()
    { //create query

        $query = 'SELECT * FROM '.$this->table.' ORDER BY created_at DESC';

        //prepared statement

        $stmt = $this->conn->prepare($query);
        //execute query

        $stmt->execute();

        return $stmt;

    }

    //get single post

    public function read_single() {

        $query = 'SELECT * 
                  FROM '.$this->table.'
                  where id = ? limit 0,1';

        //prepared statement

        $stmt = $this->conn->prepare($query);

        
         //bind param

         $stmt->bindParam(1, $this->id);

        //execute query

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //set properties
       
        $this->name = $row['name'];


    }

    public function create() {
        //create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
         name = :name
         ';

         //prepare statement

         $stmt = $this->conn->prepare($query);

         //clean data
         $this->name = htmlspecialchars(strip_tags($this->name));
       

         //bind the data

         $stmt->bindParam(':name', $this->name);
       

         //execute query
         if($stmt->execute())
         {
             return true;
         }

         //print error if something goes wrong
         printf("Error: %s.\n", $stmt->error);

         return false;
    }

    public function update() {
        //create query
        $query = 'UPDATE ' . $this->table . '
        SET
         name = :name
        WHERE
         id = :id
         ';

         //prepare statement

         $stmt = $this->conn->prepare($query);

         //clean data
         $this->name = htmlspecialchars(strip_tags($this->name));
         
         $this->id = htmlspecialchars(strip_tags($this->id));


         //bind the data

         $stmt->bindParam(':name', $this->name);
        
         $stmt->bindParam(':id', $this->id);

         //execute query
         if($stmt->execute())
         {
             return true;
         }

         //print error if something goes wrong
         printf("Error: %s.\n", $stmt->error);

         return false;
    }

    //delete category

    public function delete()
    {
        $query = 'DELETE FROM '. $this->table . ' WHERE id = :id';

        //prepare the statement
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

         //execute query
         if($stmt->execute())
         {
             return true;
         }

         //print error if something goes wrong
         printf("Error: %s.\n", $stmt->error);

         return false;
    }
}

