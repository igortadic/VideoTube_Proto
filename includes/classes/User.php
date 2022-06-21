<?php
class User {

  private $con, $sqlData;

  public function __construct($con, $username) {
      $this->con = $con;

      $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
      $query->bindParam(":un", $username);
      $query->execute();

      $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
  }

  public function getUsername() {
    return User::userLoggedInObj() ? $this->sqlData["username"] : "";
  }

}
?>
