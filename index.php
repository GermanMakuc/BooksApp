<!doctype html>
<html lang="en">
  <?php include_once('./includes/header.php');?>
  <body>
    <?php include_once('./includes/menu.php');?>

    <div class="container">
        <div class="input-group mb-3 mt-3">
            <input id="searchValue" type="text" class="form-control" placeholder="Buscar" aria-label="Buscar" aria-describedby="searchButton">
            <button id="searchButton" class="btn btn-outline-secondary" type="button">Buscar</button>
        </div>
        <div class="loading text-center"></div>
        <div id="bookCards" class="row row-cols-1 row-cols-md-4 g-4 text-center">
            <div class="originalCard col">
                <div class="card">
                    <a href="">
                        <img src="" class="card-img-top mt-3" alt="">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <small class="card-text"></small>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Versión: </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('./includes/footer.php');?>

  </body>
</html>