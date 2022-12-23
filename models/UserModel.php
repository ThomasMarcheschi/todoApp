<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/models/DB.php";

class UserModel extends DB{
  private $email;
  private $password;

  function __construct($email, $password){
    parent::__construct();
    $this -> email = $email;
    $this -> password = $password;
  }

  function addToDB(){
    $stmt = $this -> getConnect() -> prepare('INSERT INTO users (email, password) VALUES (? ,?)');

    $stmt -> bindParam(1, $this -> email);
    $stmt -> bindParam(2, $this -> password);

    $stmt -> execute();
  }

  function fetch() : array{
    $stmt = $this -> getConnect() -> prepare('SELECT * FROM users WHERE email=?');

    $stmt -> bindParam(1, $this ->email);

    $res = $stmt -> execute();
    
    $userFromDB = $stmt -> fetch(PDO::FETCH_ASSOC);
    
    return $userFromDB;
  }
}