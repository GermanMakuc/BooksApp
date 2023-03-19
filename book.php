<?php

require('./classes/favorites.php');
require('./classes/comments.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $api_url = 'https://www.googleapis.com/books/v1/volumes/'. $id;

    $json_data = file_get_contents($api_url);
    
    $response_data = json_decode($json_data);

    $favorite = new Favorites();
    $results = $favorite->findByID($id);

    $comments = new Comments();
    $commentsResults = $comments->findAllbyID($id);

}
else
{
    header("Location: index.php");
    exit();
}


?>
<?php if(isset($_GET['id'])) { ?>
<!doctype html>
<html lang="en">
  <?php include_once('./includes/header.php');?>
  <body>
    <?php include_once('./includes/menu.php');?>

    <div class="container">
        <div class="row pt-3">
            <div class="col-md-4 text-center">
                <div class="col">
                    <div class="card" data-id="<?php echo($response_data->id); ?>" data-image="<?php echo($response_data->volumeInfo->imageLinks->thumbnail); ?>" data-title="<?php echo($response_data->volumeInfo->title); ?>" data-description="<?php echo($response_data->volumeInfo->description); ?>" data-version="<?php echo($response_data->volumeInfo->contentVersion); ?>" data-link="<?php echo($response_data->volumeInfo->canonicalVolumeLink); ?>">
                        <a href="" target="_blank">
                            <img src="<?php echo($response_data->volumeInfo->imageLinks->thumbnail); ?>" class="card-img-top mt-3" alt="">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo($response_data->volumeInfo->title); ?></h5>
                            <small class="card-text"><?php echo($response_data->volumeInfo->description); ?></small>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Versión: <?php echo($response_data->volumeInfo->contentVersion); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <nav class="nav nav-pills flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="<?php echo($response_data->volumeInfo->canonicalVolumeLink); ?>" target="_blank">Ver Detalles</a>
                    <?php if(count($results) == 0) {?>
                        <a id="savedAction" href="#" class="flex-sm-fill text-sm-center nav-link">Agregar a mis Guardados</a>
                    <?php } else { ?>
                        <a id="savedAction" href="#" class="flex-sm-fill text-sm-center nav-link">Borrar de mis Guardados</a>
                    <?php } ?>
                </nav>
                <div class="mt-3">
                    <label for="comments" class="form-label">Comentarios</label>
                    <?php if(count($commentsResults) > 0){ ?>
                        <textarea id="commentValue" class="form-control" id="comments" rows="5"><?php echo($commentsResults[0]['comments']); ?></textarea>
                    <?php } else { ?>
                        <textarea id="commentValue" class="form-control" id="comments" rows="5"></textarea>
                    <?php } ?>
                    
                    <button id="addComment" type="button" class="mt-3 btn btn-primary btn-lg">Agregar Comentario</button>
                </div>
            </div>
        </div>
        
    </div>

    <?php include_once('./includes/footer.php');?>

  </body>
</html>
<?php } ?>