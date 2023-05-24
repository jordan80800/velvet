<?php
session_start();

if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if($_POST["user"]=="user"&&$_POST["password"]=="mdp"){
        $_SESSION["auth"]= "ok";
       echo "user:".$_POST['user']."<br>Password:".$_POST['password']; 
    }
    else{
        unset($_SESSION["auth"]);
        echo "user or password is false" ;
    }
}



?>