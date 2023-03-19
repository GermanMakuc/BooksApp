<?php

require_once("connection.php");

class Favorites {
    public $id_google_book;
    public $image;
    public $title;
    public $description;
    public $version;

    public function __construct()   {

    }

    public function add(){
        $db = new connectionDB ();
        $sql = "INSERT INTO favoritos (id_book, image, title, description, version) VALUES (:id_book, :image, :title, :description, :version)";
        $consulta = $db->connection->prepare($sql);
        $consulta->bindParam(':id_book', $this->id_google_book);
        $consulta->bindParam(':image', $this->image);
        $consulta->bindParam(':title', $this->title);
        $consulta->bindParam(':description', $this->description);
        $consulta->bindParam(':version', $this->version);
        $consulta->execute();
    }

    public function countByID($id){
        $db = new connectionDB ();
        $sql = "SELECT * FROM favoritos WHERE id_book = :id_book";
        $consulta = $db->connection->prepare($sql);
        $consulta->bindParam(':id_book', $id);
        $consulta->execute();
        $results = $consulta->rowCount();
        return $results;
    }

    public function findByID($id){
        $db = new connectionDB ();
        $sql = "SELECT * FROM favoritos WHERE id_book = :id_book";
        $consulta = $db->connection->prepare($sql);
        $consulta->bindParam(':id_book', $id);
        $consulta->execute();
        $results = $consulta->fetchAll();
        return $results;
    }

    public function findAll(){
        $db = new connectionDB ();
        $sql = "SELECT * FROM favoritos";
        $consulta = $db->connection->prepare($sql);
        $consulta->execute();
        $results = $consulta->fetchAll();
        return $results;
    }

    public function delete($id){
        $db = new connectionDB();
        $sql = "DELETE FROM favoritos WHERE id_book = :id_book";
        $consulta = $db->connection->prepare($sql);
        $consulta->bindParam(':id_book', $id);
        $consulta->execute();
    }
}

?>