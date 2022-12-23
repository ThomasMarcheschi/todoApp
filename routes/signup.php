<?php
  include_once "../controllers/UserController.php";


  if(isset($_POST['email'], $_POST['password'])){
    //Istancier la classe
    $user = new UserController($_POST['email'], $_POST['password']);

    if($user -> isDataValid()){
      //Todo: Tester si l'utilisateur s'est deja inscrit
      //ajouter le user dans la DB:
      $user -> signupUser();
      header('Location: /login.php');
    }else{
      $returnData = $user -> getErrors();
      header('Location: /login.php?' . $returnData);
    }

  }else{
    header('Location: /login.php');
  }