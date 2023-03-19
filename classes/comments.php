<?php

require_once("connection.php");

class Comments {
    public $id_google_book;
    public $comments;

    public function __construct()   {

    }

    public function add(){
        $db = new connectionDB ();
        $sql = "INSERT INTO comentarios (id_book, comments) VALUES (:id_book, :comments)";
        $consulta = $db->connection->prepare($sql);
        $consulta->bindParam(':id_book', $this->id_google_book);
        $consulta->bindParam(':comments', $this->comments);
        $consulta->execute();
    }

    public function findByID($id){
        $db = new connectionDB ();
        $sql = "SELECT * FROM comentarios WHERE id_book = :id_book";
        $consulta = $db->connection->prepare($sql);
        $consulta->bindParam(':id_book', $id);
        $consulta->execute();
        $results = $consulta->rowCount();
        return $results;
    }

    public function findAll(){
        $db = new connectionDB ();
        $sql = "SELECT * FROM comentarios";
        $consulta = $db->connection->prepare($sql);
        $consulta->execute();
        $results = $consulta->fetchAll();
        return $results;
    }

    public function findAllbyID($id){
        $db = new connectionDB ();
        $sql = "SELECT * FROM comentarios WHERE id_book = :id_book";
        $consulta = $db->connection->prepare($sql);
        $consulta->bindParam(':id_book', $id);
        $consulta->execute();
        $results = $consulta->fetchAll();
        return $results;
    }

    public function update($id){
        $db = new connectionDB();
        $sql = "UPDATE comentarios SET comments=:comments WHERE id_book = :id_book";
        $consulta = $db->connection->prepare($sql);
        $consulta->bindParam(':comments', $this->comments);
        $consulta->bindParam(':id_book', $id);
        $consulta->execute();
    }

    public function getData($id){
        $api_url = 'https://www.googleapis.com/books/v1/volumes/'. $id;
        $json_data = file_get_contents($api_url);
        $response_data = json_decode($json_data);
        return $response_data;
    }
}

?>