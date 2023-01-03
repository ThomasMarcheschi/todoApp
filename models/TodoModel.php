<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/models/DB.php";
class todoModel extends DB{

  private $content;
  private $authorID;
  private $id;

  function __construct($todo, $authorID){
    parent::__construct();
    $this -> content = $todo;
    $this -> authorID = $authorID;
  }

  function addTodo(){
    var_dump($this -> getConnect());
    $stmt = $this -> getConnect() -> prepare("INSERT INTO todos (content, authorID) VALUES (?, ?)");

    $stmt -> bindParam(1, $this -> content);
    $stmt -> bindParam(2, $this -> authorID);

    $stmt -> execute();
    $this -> id =  $this -> getConnect() -> lastInsertId();

    return $this -> fetch();
  }

  function fetch(){
    $stmt = $this -> getConnect() -> prepare("SELECT * FROM todos WHERE id=?");
    $stmt -> bindParam(1, $this ->id);
    $stmt -> execute();
    return $stmt -> fetch(PDO::FETCH_ASSOC);
  }

  static function fetchAll($authorID){
    $connect = DB::getConnection();
    $stmt = $connect ->getConnect() -> prepare("SELECT * FROM todos WHERE authorID = ?");
    $stmt -> bindParam(1, $authorID);
    $stmt -> execute();
    return $stmt -> fetchAll(PDO::FETCH_ASSOC); 
  }

  static function updateIsDone($todoID){
    $active = true;
    $connect = DB::getConnection();
    $stmt = $connect -> getConnect() -> prepare("UPDATE todos SET isDone=? WHERE id=?");
    $stmt -> bindParam(1, $active);
    $stmt -> bindParam(2, $todoID);
    $stmt -> execute();
  }

  static function removeTodo($id){
    $connect = DB::getConnection();
    $stmt = $connect -> getConnect() -> prepare('DELETE FROM todos WHERE id=?');
    $stmt ->bindParam(1, $id);
    $stmt -> execute();
  }

}