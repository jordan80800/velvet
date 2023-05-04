<?php
require "db.php";
$db = connexionBase();

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
  <h1>Formulaire D'ajout</h1>
  <hr>
  <h3>Ajoutez un vinyle</h3> <br>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="Nom" class="form-label">Title</label>
      <input type="text" placeholder="Entrez un pseudo" class="form-control" id="Nom" name="title">
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Artist</label>
      <input type="text" placeholder="Enter Title" class="form-control" id="exampleInputPassword1" name="artist">
    </div>


    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Year</label>
      <input type="text" placeholder="queens of the Stones Age" class="form-control" id="Adresses" name="years">
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
      <input type="file" id="myFile" name="file">
    </div> <br> <br>

    <button type="submit" name="modif" class="btn btn-primary">Envoyer</button>
    <a href="index.php" class="btn btn-danger" type="button">Annuler</a>

  </form>




  </div>
  <?php
  if (isset($_POST['modif'])) {
    // Récupération des valeurs :
    $title = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
    $artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
    $years = (isset($_POST['years']) && $_POST['years'] != "") ? $_POST['years'] : Null;
    $genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
    $label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
    $price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;


    if (isset($_FILES)) {
      if ($_FILES['file']['name']) {
        try {
          $uploadDir = "assets/img/jaquettes/";
          $file_name = $_FILES['file']['name'];
          $tmpfilepath = $_FILES['file']['tmp_name'];
          $newfilepath = $uploadDir . $file_name;
          $imgSucces = move_uploaded_file($_FILES["file"]["tmp_name"], $newfilepath);
        } catch (Exception $e) {
          echo "Erreur : " . $e . "<br>";
          die("Fin du script");
        }
      }
    }

    try {
      // Construction de la requête UPDATE sans injection SQL :
      $requete = $db->prepare("INSERT INTO disc(disc_title,disc_year,disc_picture,disc_label,disc_genre,disc_price,artist_id) VALUES(:title,:years,:file_name,:label,:genre,:price,:artist);");
      $requete->bindValue(":title", $title);
      $requete->bindValue(":years", $years);
      $requete->bindValue(":file_name", $file_name);
      $requete->bindValue(":label", $label);
      $requete->bindValue(":genre", $genre);
      $requete->bindValue(":price", $price);
      $requete->bindValue(":artist", $artist);
      $requete->execute();
      $requete->closeCursor();
    } catch (Exception $e) {
      echo "Erreur : " . $e . "<br>";
      die("Fin du script");
    }

    //header("Location: details.php?id=" . $id);
    exit;
  }

  ?>



</body>

</html>