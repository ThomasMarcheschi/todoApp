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

  function fetch() : array {
    $stmt = $this -> getConnect() -> prepare('SELECT * FROM users WHERE email=?');

    $stmt -> bindParam(1, $this ->email);

    $res = $stmt -> execute();
    
    $userFromDB = $stmt -> fetch(PDO::FETCH_ASSOC);

    if(is_bool($userFromDB)){
      return [];
    }
    
    return $userFromDB;
  }

  static function fetchByID($id){
    $connect = DB::getConnection();

    $stmt = $connect -> getConnect() -> prepare('SELECT * FROM users WHERE id=?');

    $stmt -> bindParam(1, $id);
    $res = $stmt ->execute();
    $userFromDB = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $userFromDB;
  }

  function saveImageToDB($image){
    $stmt = $this -> getConnect() -> prepare("UPDATE users SET avatar=? WHERE email=?");
    $stmt ->bindParam(1, $image);
    $stmt ->bindParam(2, $this -> email);
    $stmt ->execute();
  }
}