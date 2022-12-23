<?php

include_once "../models/UserModel.php";
class UserController{
  private $email;
  private $password;
  private $id;
  private $avatarURL;
  private $role;

  private $userModel;

  private const MIN_PASSWORD_LENGTH = 6;


  function __construct(string $email, string $password){

    $this -> email = $email;
    $this -> password = $password;
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

    if($userTab['password'] !== $this -> password){
      return false;
    }
    
    
    $this -> id = $userTab['id'];
    $this -> avatarURL = $userTab['avatar'];
    $this -> role = $userTab['role'];

    return true;
  }


  
}