<?php
session_start();
// var_dump($GLOBALS);
include_once "../controllers/UserController.php";


if(isset($_FILES['avatar'])){

  $userFromDB = UserController::createUserFromId($_SESSION['id']);
  $userController = new UserController($userFromDB['email'], $userFromDB['password']);
  
//tester si l'image est bonne: png ou jpeg ou jpg
if($userController -> isImageValid($_FILES['avatar'])){
  var_dump('dfdf');
//enregsitrer l'image dans le serveur avec le nom (id.png)
copy($_FILES['avatar']['tmp_name'], '../images/users/'.$_SESSION['id'].'.png');
//Mettre a jour l'avatar de user dans la base de données.
}else{
  header('Location: /profil.php');
}
}