<?php 

class connectionDB 
{

    public $connection;

    public function __construct() 
    {
        try
        {
            $this->connection = new PDO("mysql:host=localhost;dbname=appbooks",'root', '');
            
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e) {
            echo "Error al conectar a la base de datos: " . $e->getMessage();
        }

    }

}

?>