<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/models/TodoModel.php";

class TodoController{
  private $authorID;
  private $content;
  private $date;
  private $id;
  private $isDone;

  private $todoModel;

  function __construct($todo, $authorID){
    $this -> content = $todo;
    $this -> authorID = $authorID;
    $this -> todoModel = new TodoModel($todo, $this -> authorID);
  }

  function addTodo(){
    $todoTab = $this -> todoModel -> addTodo();
    $this -> date = $todoTab['date']; 
    $this -> id = $todoTab['id'];
    $this -> isDone = $todoTab ["isDone"];
  }

  static function fetchAll($authorID){
    return TodoModel::fetchAll($authorID);
  }

  static function validateTodo($todoID){
    TodoModel::updateIsDone($todoID);
  }

  static function removeTodo($todoID){
    TodoModel::removeTodo($todoID);
  }

}