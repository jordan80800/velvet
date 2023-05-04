<?php
// Contrôle de l'ID (si inexistant ou <= 0, retour à la liste) :
if (!(isset($_GET['disc_id'])) || intval($_GET['disc_id']) <= 0) goto TrtRedirection;

// Si la vérification est ok :
require "db.php";
$db = connexionBase();

try {
    $discid = $_GET['disc_id'];
    // Construction de la requête DELETE sans injection SQL :
    $requete = $db->prepare("DELETE FROM disc WHERE disc_id =:discid");
    $requete->execute(array(':discid' => $discid));
    $requete->closeCursor();
} catch (Exception $e) {
    echo "Erreur : " . $e . "<br>";
    die("Fin du script (script_artist_modif.php)");
}

// Si OK: redirection vers la page artists.php
TrtRedirection:
header("Location: index.php");
exit;


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>