<?php

require('../classes/comments.php');

if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $comments = $_POST['comments'];

    $commentsObj = new Comments();

    $results = $commentsObj->findByID($id);

    if($results == 0)
    {
        $commentsObj->id_google_book = $id;
        $commentsObj->comments = $comments;

        $commentsObj->add();

        $data = array("state" => true);
    }
    else
    {
        $commentsObj->comments = $comments;
        $commentsObj->update($id);
        $data = array("state" => false);
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