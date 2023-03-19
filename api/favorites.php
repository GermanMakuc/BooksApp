<?php

require('../classes/favorites.php');

if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $version = $_POST['version'];

    $favorite = new Favorites();

    $results = $favorite->countByID($id);

    if($results == 0)
    {
        $favorite->id_google_book = $id;
        $favorite->image = $image;
        $favorite->title = $title;
        $favorite->description = $description;
        $favorite->version = $version;
        $favorite->add();

        $data = array("state" => true);
    }
    else
    {
        $data = array("state" => false);
        $favorite->delete($id);
    }

    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
}
else
{
    header("Location: index.php");
    exit();
}


?>