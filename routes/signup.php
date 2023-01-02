<?php
  include_once "../controllers/UserController.php";


  if(isset($_POST['email'], $_POST['password'])){
    //Istancier la classe
    $user = new UserController($_POST['email'], $_POST['password']);

    if($user -> isDataValid()){
      //Todo: Tester si l'utilisateur s'est deja inscrit
      //ajouter le user dans la DB:
      if($user -> exist()){
        header('Location: /login?inscription=error&emailErrorExist');
        die();
      }
      $user -> signupUser();

    }else{
      $returnData = $user -> getErrors();
      header('Location: /login.php?inscription=error&' . $returnData);
    }

  }else{
    header('Location: /login.php');
  }