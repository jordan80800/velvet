<?php
include "db.php";
$db = connexionBase();
$requete = $db->query("Select * FROM disc join artist on disc.artist_id=artist.artist_id ");
$lesDisques = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">


<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><h1> Les Disques</h1></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <a href="ajout.php" class="btn btn-primary" type="button">Ajouter</a>
    </div>
  </div>
</nav>

    <div class="container-fluid g-0 h-100 d-flex align-items-center justify-content-center ">


        <div class=" row  col-md-6 ">
            <?php foreach ($lesDisques as $undisque) : ?>
                <div class="card col-md-6 border-0">
                    <div class=" row g-0 ">
                        <div class="col-md-6">
                            <img src="assets/img/jaquettes/<?= $undisque['disc_picture'] ?>" class="img w-75 h-75 rounded-circle " alt="pourquoi sa s'affiche pas !!!!!!" id="image">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title"><?= $undisque['disc_title'] ?></h5>
                                <p class="card-text"><?= $undisque['artist_name']  ?></p>
                                <p class="card-text"><?= $undisque['disc_label'] ?></p>
                                <p class="card-text"><?= $undisque['disc_year'] ?></p>
                                <p class="card-text"><?= $undisque['disc_genre'] ?></p>
                                <input type="button" onclick="window.location.href='details.php?disc_id=<?=$undisque['disc_id']?>';" class="btn btn-danger btn" value="Détails"/>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>