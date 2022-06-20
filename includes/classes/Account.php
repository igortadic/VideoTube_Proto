<?php
class Account {

  private $con;
  private $errorArray = array();

  public function __construct($con) {
    $this->con = $con;
  }

  public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
    $this->validateFirstName($fn);
  }

  private function validateFirstName($fn) {
     if(strlen($fn) > 25 || strlen($fn) < 2) {
       array_push($this->errorArray, Constants::$firstNameCharacters);
     }
  }

  private function validateUsername($un) {
     if(strlen($fn) > 25 || strlen($un) < 5) {
       array_push($this->errorArray, Constants::$usernameCharacters);
       return;
     }

     $query = $this->conn->prepare("SELECT username FROM users WHERE username=:un");
     $query->bindParam(":un", $un);
     $query->execute();

     if($query->rowCount() != 0) {
       array_push($this->errorArray, Constants::$usernameTaken);
     }
  }

  private function validateLastName($ln) {
     if(strlen($fn) > 25 || strlen($ln) < 2) {
       array_push($this->errorArray, Constants::$lastNameCharacters);
     }
  }

  public function getError($error) {
    if(in_array($error, $this->errorArray)) {
      return "<span class='errorMessage'>$error</span>";
    }
  }

}
?>
