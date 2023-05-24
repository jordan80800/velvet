<?php
include "db.php";
$db = connexionBase();
$requete = $db->query("Select * FROM disc join artist on disc.artist_id=artist.artist_id ");
$lesDisques = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
$count = $db->query("SELECT COUNT(disc_id) AS count FROM disc")->fetchColumn();
?>
<?php
$requete = $db->prepare("SELECT disc_lien FROM disc WHERE disc_id= :disc_id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary m-0 p-0">
        <div class="container-fluid p-0 m-0" id="nav1">
            <a class="navbar-brand" href="#">
                <h1 class="text-light mt-3"> Les Disques<?php echo "($count)" ?></h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <b><a href="sign_up.php" class="btn btn-danger mt-3" type="button" id="buttonlog">sign up</a></b>
                <a href="login_form.php" class="btn btn-danger mt-3" type="button" id="buttonout">sign in</a>
                <a href="ajout.php" class="btn btn-primary mt-3" type="button" id="buttonajout">Ajouter</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row" id="site">
            <?php foreach ($lesDisques as $undisque) : ?>
                <div class="g-4 col-6">
                    <div class="card cardd p-3">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center align-items-center m-auto">
                                <img src="assets/img/jaquettes/<?= $undisque['disc_picture'] ?>" class="img w-100 h-100 rounded-circle  " alt="pourquoi sa s'affiche pas !!!!!!" id="image">
                            </div>
                            
                            <div class="col-8 g-3">
                                <div class="card-body">
                                    <h5 class="card-title text-light"><?= $undisque['disc_title'] ?></h5>
                                    <p class="card-text text-light"><?= $undisque['artist_name']  ?></p>
                                    <p class="card-text text-light"><?= $undisque['disc_label'] ?></p>
                                    <p class="card-text text-light"><?= $undisque['disc_year'] ?></p>
                                    <p class="card-text text-light"><?= $undisque['disc_genre'] ?></p>
                                    <div class="row">
                                        <div class="col-6">
                                            <a text-light onclick="window.location.href='details.php?disc_id=<?= $undisque['disc_id'] ?>';" class="d-block btn " id="bout">détails</a>
                                        </div>
                                        <div class="col-6">
                                            <a text-light onclick="window.location.href='<?= $undisque['disc_lien'] ?>';" class="d-block btn " id="bout">play</a>
                                        </div>
                                    </div>
                                </div>
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