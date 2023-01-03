<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/UserController.php";

$userController = UserController::createUserFromId($_SESSION['id']);

$userController -> validateTodo($_GET['validate']);

header('Location: /profil.php');