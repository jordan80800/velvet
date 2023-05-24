<?php
include "db.php";
$db = connexionBase();
session_start();
$_SESSION["login"] = "Velvet";
echo $_SESSION["login"];
$_SESSION["role"] = "admin";
echo "- session ID :  " . session_id();
$password_hash = password_hash("vacances", PASSWORD_DEFAULT);
echo "vacance :" . $password_hash;

if ($_SESSION["login"]) {
  echo "Vous êtes autorisé à voir cette page.";
} else {
  echo "Cette page nécessite une identification.";
}



if (isset($_POST['submitted'])) {
  // Récupération des valeurs :
  $firstname = (isset($_POST['firstname']) && $_POST['firstname'] != "") ? $_POST['firstname'] : Null;
  $laste = (isset($_POST['lastename']) && $_POST['lastename'] != "") ? $_POST['lastename'] : Null;
  $email = (isset($_POST['email']) && $_POST['email'] != "" && $_POST['email'] === filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ? $_POST['email'] : Null;
  $mdp = (isset($_POST['mdp']) && $_POST['mdp'] != "") ? password_hash($_POST['mdp'], PASSWORD_DEFAULT) : Null;



  var_dump($email);
  if ($firstname != Null && $laste != Null && $email != Null && $mdp != Null) {
    try {
      // Construction de la requête UPDATE sans injection SQL :
      $requete = $db->prepare("INSERT INTO user(user_firstname,user_lastename,user_mail,user_mdp) VALUES(:firstname,:lastename,:mail,:mdp);");
      $requete->bindValue(":firstname", $firstname);
      $requete->bindValue(":lastename", $laste);
      $requete->bindValue(":mail", $email);
      $requete->bindValue(":mdp", $mdp);
      $requete->execute();
      $requete->closeCursor();
    } catch (Exception $e) {
      echo "Erreur : " . $e . "<br>";
      die("Fin du script");
    }

    //header("Location: details.php?id=" . $id);
    exit;
  } else {
    header("Location: sign_up.php" . $id);
  }
}


?>


<!doctype html>
<html lang="fr">

<head>
  <title>Log IN</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="style.css" rel="stylesheet">
</head>

<body id="body1">
  <div class="login-box">
    <h2>Sign UP</h2>
    <form id="formconnexion" method="POST">
      <div class="user-box">
        <input type="text" name="firstname" required="">
        <label>First Name</label>
      </div>
      <div class="user-box">
        <input type="text" name="lastename" required="">
        <label>Last Name</label>
      </div>
      <div class="user-box">
        <input type="text" name="email" required="">
        <label>Email</label>
      </div>
      <div class="user-box">
        <input type="password" name="mdp" required="">
        <label>password</label>
      </div>
      <div class="user-box">
        <input type="password" name="" required="">
        <label>confirm password</label>
      </div>
      <input type="hidden" name="submitted">
      <a href="#" onclick="parentNode.submit();">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Envoyer
      </a>
      <a href="index.php">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Retour
      </a>

    </form>
  </div>
</body>

</html>