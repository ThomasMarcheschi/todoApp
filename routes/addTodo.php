<?php
session_start();
include_once "../controllers/UserController.php";

if(isset($_POST['todo'])){

  $userController = UserController::createUserFromId($_SESSION['id']);
  $userController -> addTodo($_POST['todo']);

}

header('Location: /profil.php');