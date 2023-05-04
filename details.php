<?php
include "db.php";
$db = connexionBase();
if (isset($_GET['disc_id'])) { // mise à jour
    $discid = $_GET['disc_id'];
    $requete = $db->prepare("Select * FROM disc join artist on disc.artist_id=artist.artist_id WHERE disc_id=:discid");
    $requete->execute([':discid' => $discid]);
    $undisque = $requete->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">

        <div class="row col-md-12">
            <div class="col md-6">
                <label for="Ville" class="form-label">Title</label>
                <input type="text" placeholder="<?= $undisque['disc_title'] ?>" class="form-control" id="Title" aria-describedby="emailHelp" disabled>
            </div>
            <div class="col-md-6">
                <label for="Ville" class="form-label">Artist</label>
                <input type="text" placeholder="<?= $undisque['artist_name'] ?>" class="form-control" id="Artiste" aria-describedby="emailHelp" disabled>
            </div>
        </div>
        <div class="row col-md-12">
            <div class="col md-6">
                <label for="Ville" class="form-label">Year</label>
                <input type="text" placeholder="<?= $undisque['disc_year'] ?>" class="form-control" id="Year" aria-describedby="emailHelp" disabled>
            </div>
            <div class="col-md-6">
                <label for="Ville" class="form-label">Genre</label>
                <input type="text" placeholder="<?= $undisque['disc_genre'] ?>" class="form-control" id="Genre" aria-describedby="emailHelp" disabled>
            </div>
        </div>
        <div class="row col-md-12">
            <div class="col md-6">
                <label for="Ville" class="form-label">Label</label>
                <input type="text" placeholder="<?= $undisque['disc_label'] ?>" class="form-control" id="label" aria-describedby="emailHelp" disabled>
            </div>
            <div class="col-md-6">
                <label for="Ville" class="form-label">Price</label>
                <input type="text" placeholder="<?= $undisque['disc_price'] . "€" ?>" class="form-control" id="price" aria-describedby="emailHelp" disabled>
            </div>
        </div> <br>
        <div class="row col-md-6">
            <img src="assets/img/jaquettes/<?= $undisque['disc_picture'] ?>" class="img w-50 h-25  " alt="pourquoi sa s'affiche pas !!!!!!">
        </div> <br>
        <div class="row ">
            <div class="d-grid gap-2 d-md-block">
                <input type="button" onclick="window.location.href='modif.php?disc_id=<?= $undisque['disc_id'] ?>';" class="btn btn-warning btn" value="Modifier" />
                <input type="button" onclick="window.location.href='script_disc_delete.php?disc_id=<?= $undisque['disc_id'] ?>';" class="btn btn-primary btn" value="Supprimer" />
                <a href="index.php" class="btn btn-danger" type="button">retour</a>
            </div>



        </div>


    </div>








</body>

</html>