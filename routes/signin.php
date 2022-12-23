<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/UserController.php";



if(!(isset($_POST['email'], $_POST['password']))){
  header("Location: /login.php");
  die();
}

$user = new UserController($_POST['email'], $_POST['password']);

if(!($user -> isDataValid())){
  header("Location: /login.php?" . $user -> getErrors());
  die();
}

//Verifier si l'utilisateur existe
if(!$user -> exist()){
  header("Location: /login.php?emailError=EmailDosntExist" );
}

$_SESSION["email"] = $user ->getEmail();
$_SESSION["id"] = $user -> getId();
$_SESSION["avatar"] = $user -> getAvatar();
$_SESSION["role"] = $user -> getRole();

header("Location: /profil.php");