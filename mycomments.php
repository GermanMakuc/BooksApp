<?php

require('./classes/comments.php');
require('./classes/favorites.php');

$comments = new Comments();
$result = $comments->findAll();

?>

<!doctype html>
<html lang="en">
  <?php include_once('./includes/header.php');?>
  <body>
    <?php include_once('./includes/menu.php');?>

    <div class="container">
      <?php if(count($result) > 0) { ?>
        <div class="mt-3 row row-cols-1 row-cols-md-3 g-3 text-center">
        <?php foreach ($result as $row) { ?>
        <?php $response = $comments->getData($row['id_book']); ?>
                <div class="col">
                    <div class="card">
                        <a href="book.php?id=<?php echo($row['id_book']); ?>">
                            <img src="<?php echo($response->volumeInfo->imageLinks->thumbnail); ?>" class="card-img-top mt-3" alt="">
                        </a>
                        <div class="card-body">
                        <figure class="text-center">
                            <blockquote class="blockquote">
                                <p><?php echo($response->volumeInfo->title); ?>.</p>
                            </blockquote>
                            <figcaption class="blockquote-footer">
                            <?php echo($row['comments']); ?>
                            </figcaption>
                        </figure>
                        </div>
                        <div class="card-footer">
                            <a href="book.php?id=<?php echo($row['id_book']); ?>" class="btn btn-primary btn-sm">Ver Más</a>
                            <small class="text-muted">Versión: <?php echo($response->volumeInfo->contentVersion); ?></small>
                        </div>
                    </div>
                </div>
          <?php } ?>
          </div>
          <?php } else {?>
            <div class="mt-3 alert alert-danger" role="alert">
              No tienes ningún comentario guardado aún!
            </div>
            <?php } ?>
        
       
    </div>

    <?php include_once('./includes/footer.php');?>

  </body>
</html>