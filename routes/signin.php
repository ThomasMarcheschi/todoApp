<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/UserController.php";



if(!(isset($_POST['email'], $_POST['password']))){
  header("Location: /login.php");
  die();
}

$user = new UserController($_POST['email'], $_POST['password']);

if(!($user -> isDataValid())){
  header("Location: /login.php?connexion=error&" . $user -> getErrors());
  die();
}

//Verifier si l'utilisateur existe
if(!$user -> exist()){
  header("Location: /login.php?connexion=error&emailError=EmailDosntExist" );
  die();
}

//Implementer la méthode:
//1. Faire une requete vers la BD avec email.
//2. Tester si le mot de passe recu est le meme que celui la DB return true sinon false.

if(!$user -> isPasswordCorrect()){
  header("Location: /login.php?connexion=error&passwordError=PasswordIncorrect" );
  die();
}



$_SESSION["email"] = $user ->getEmail();
$_SESSION["id"] = $user -> getId();
$_SESSION["avatar"] = $user -> getAvatar();
$_SESSION["role"] = $user -> getRole();

header("Location: /profil.php");