<?php
include "db.php";
$db = connexionBase();
session_start();
$_SESSION["login"] = "Velvet";
// echo $_SESSION["login"];
// $_SESSION["role"] = "admin";
// echo"- session ID :  ".session_id();
// $password_hash = password_hash("vacances", PASSWORD_DEFAULT);
// echo "vacance :".$password_hash; 

if ($_SESSION["login"]) {
  //  echo"Vous êtes autorisé à voir cette page.";  
} else {
  echo "Cette page nécessite une identification.";
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Log IN</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body id="body1">

  <div class="login-box">
    <h2>Login</h2>
    <form method="POST" action="log_in_script.php" id="formconnexion">
      <div class="user-box">
        <input type="text" name="user" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>
      <a href="#" onclick="document.getElementById('formconnexion').submit();">
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