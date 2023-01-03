<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/models/UserModel.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/TodoController.php";

class UserController{
  private $email;
  private $password;
  private $id;
  private $avatarURL;
  private $role;
  private $todos = [];

  private $userModel;

  private const MIN_PASSWORD_LENGTH = 6;


  function __construct(string $email, string $password){

    $this -> email = $email;
    $this -> password = $password;

    $this -> userModel = new UserModel($email, $password);
  }

  /**
   * Acceder a la valeur de l'email
   */
  public function getEmail() : string
  {
    return $this->email;
  }

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Get the value of avatarURL
   */
  public function getAvatar()
  {
    return $this->avatarURL;
  }

  /**
   * Get the value of role
   */
  public function getRole()
  {
    return $this->role;
  }

  /**
   * Set the value of email
   */
  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }

  function isEmailValid() : bool{
    // trouver un moyen pour tester si une sous chaine est dans une chaine
    return filter_var($this -> email, FILTER_VALIDATE_EMAIL);
  }

  function isPasswordValid() : bool{
    //Teste si la taille password est sup. a 6 ou pas:
    return strlen($this -> password) >= self::MIN_PASSWORD_LENGTH;
  }

  function isDataValid() : bool{
    return $this -> isEmailValid() && $this -> isPasswordValid();
  }

  function getErrors(){
    //email pas valid et password valid: emailError=InputInvalid
    //email valid et passworf pas valid: passwordError=InputInvalid
    //email pas valid et password pas valid: emailError=InputInvalid&passwordError=InputInvalid
    $errors = [];
    !$this ->isEmailValid() ? array_push($errors, "emailError=InputInvalid") : null;
    !$this ->isPasswordValid() ? array_push($errors, "passwordError=InputInvalid") : null;
    // ['emailError=InputInvalid'] -> 'emailError=InputInvalid'
    // ['passwordError=InputInvalid'] -> 'passwordError=InputInvalid'
    // ['emailError=InputInvalid', 'passwordError=InputInvalid'] -> 'emailError=InputInvalid&passwordError=InputInvalid'
    return join("&", $errors);
  }

  function signupUser(){
    //Utiliser une class UserModel pour ajouter les user dans la DB.
    $userModel = new UserModel($this -> email, $this -> password);
    $userModel -> addToDB();

  }

  function exist(){
    $userModel = new UserModel($this -> email, $this -> password);
    
    $userTab = $userModel -> fetch(); 
    var_dump($userTab);
    if(count($userTab) === 0){
      return false;
    }
    
    $this -> id = $userTab['id'];
    $this -> avatarURL = $userTab['avatar'];
    $this -> role = $userTab['role'];

    return true;
  }

  function isPasswordCorrect(){
    $userFromDB = $this -> userModel -> fetch();

    return $userFromDB['password'] === $this -> password;
  }

  static function createUserFromId($id){
    $userFromDB = UserModel::fetchByID($id);
    $controller = new self($userFromDB['email'], $userFromDB['password']);
    $controller -> id = $id;
    $controller -> role = $userFromDB['role'];
    $controller -> avatarURL = $userFromDB['avatar'];
    
    $controller -> todos = TodoController::fetchAll($id);
    
    return $controller;
  }

  function isImageValid($avatar){
    $imageInfo = pathinfo($avatar['name']);

    return in_array($imageInfo['extension'], array('jpg', 'jpeg', 'png', 'gif', 'svg'));
  }

  function saveImage($avatar){
    $imageInfo = pathinfo($avatar['name']);
    $image = $_SESSION['id'].'.'.$imageInfo['extension'];
    copy($avatar['tmp_name'], '../images/users/'. $image);

    //Utiliser le model pour mettre a jour user dans la DB.
    $this ->userModel -> saveImageToDB($image);
    return $image;
  }

  function addTodo($todo){
    $todoController = new TodoController($todo, $this -> id);

    $todoController -> addTodo();
  }

  /**
   * Get the value of todos
   */
  public function getTodos(){
    return $this->todos;
  }

  function validateTodo($todoID){
    TodoController::validateTodo($todoID);
  }

  function removeTodo($todoID){
    TodoController::removeTodo($todoID);
  }
}