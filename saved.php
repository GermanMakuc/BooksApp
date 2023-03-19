<?php

require('./classes/favorites.php');

$favorites = new Favorites();
$result = $favorites->findAll();

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
              <div class="col">
                  <div class="card">
                      <a href="book.php?id=<?php echo($row['id_book']); ?>">
                          <img src="<?php echo($row['image']); ?>" class="card-img-top mt-3" alt="">
                      </a>
                      <div class="card-body">
                          <h5 class="card-title"><?php echo($row['title']); ?></h5>
                          <small class="card-text"><?php echo($row['description']); ?></small>
                      </div>
                      <div class="card-footer">
                          <a href="book.php?id=<?php echo($row['id_book']); ?>" class="btn btn-primary btn-sm">Ver Más</a>
                          <small class="text-muted">Versión: <?php echo($row['version']); ?></small>
                      </div>
                  </div>
              </div>
          <?php } ?>
          </div>
          <?php } else {?>
            <div class="mt-3 alert alert-danger" role="alert">
              No tienes ningún libro guardado aún!
            </div>
            <?php } ?>
        
       
    </div>

    <?php include_once('./includes/footer.php');?>

  </body>
</html>