<?php

require "db.php";
$db = connexionBase();


try {
    $requete = $db->prepare("SELECT * FROM artist");
    $requete->execute();
    $lesArtistes = $requete->fetchAll(PDO::FETCH_ASSOC);
    $requete->closeCursor();
} catch (Exception $e) {
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <form method="post">
        <div class="mb-3">
            <label for="Nom" class="form-label">Title</label>
            <input type="text" placeholder="Entrez un pseudo" class="form-control" id="Nom" name="title">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Artist</label>
            <select name="artist" id="artist" class="form-control">
                <?php
                foreach ($lesArtistes as $unArtiste) {
                ?>
                    <option value="<?= $unArtiste['artist_id'] ?>"><?= $unArtiste['artist_name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>


        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Year</label>
            <input type="text" placeholder="queens of the Stones Age" class="form-control" id="Adresses" name="year">
        </div>

        <div class="mb-3 ">
            <label for="exampleInputPassword1" class="form-label">Genre</label>
            <input type="text" placeholder="Entrez un pseudo" class="form-control" id="Adresses" name="genre">
        </div>

        <div class="mb-3">
            <label for="Ville" class="form-label">Label</label>
            <input type="text" placeholder="Entrez un pseudo" class="form-control" id="Villes" aria-describedby="emailHelp" name="label">
        </div>

        <label for="email">Price</label><input class="imput form-control" type="text" placeholder="Entrez un pseudo" name="price" id="email"><br> <br>
        <div class="row">

            <a>Picture</a> <br>
            <input type="file" id="myFile" name="filename">
        </div> <br> <br>

        <button type="submit" name="modif" class="btn btn-primary">Envoyer</button>
        <a href="index.php" class="btn btn-warning" type="button">retour</a>

    </form>
    <?php
    if (isset($_POST['modif'])) {
        // Récupération des valeurs :
        $disc_id = (isset($_GET['disc_id']) && $_GET['disc_id'] != "") ? $_GET['disc_id'] : Null;
        $title = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
        $artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
        $year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;
        $genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
        $label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
        $price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;

        // En cas d'erreur, on renvoie vers le formulaire
        if ($disc_id == Null || $title == Null || $artist == null || $year == null || $genre == null || $label == null || $price == null) {
            header("Location: index.php");
        }

        // Si la vérification des données est ok :

        try {
            // Construction de la requête UPDATE sans injection SQL :
            $requete = $db->prepare("UPDATE disc SET disc_title=:title, disc_year=:year, disc_label=:label, disc_genre=:genre, disc_price=:price, artist_id=:artist WHERE disc_id=:disc_id;");
            $requete->bindValue(":disc_id", $disc_id);
            $requete->bindValue(":title", $title);
            $requete->bindValue(":artist", $artist);
            $requete->bindValue(":year", $year);
            $requete->bindValue(":genre", $genre);
            $requete->bindValue(":label", $label);
            $requete->bindValue(":price", $price);
            $requete->execute();
            $requete->closeCursor();
        } catch (Exception $e) {
            echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
            die("Fin du script");
        }

        // Si OK: redirection vers la page artist_detail.php
        header("Location: index.php?id=" . $id);
        exit;
    }
    ?>
</body>

</html>