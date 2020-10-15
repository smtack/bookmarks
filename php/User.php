<?php
class User {
  private $db;
  private $table_name = "users";

  public $username;
  public $email;
  public $password;

  public function __construct($newDB) {
    $this->db = $newDB;
  }

  function signUp() {
    $query = "INSERT INTO " . $this->table_name . "(username, email, password) VALUES (:username, :email, :password)";

    $stmt = $this->db->prepare($query);

    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->password = htmlspecialchars(strip_tags($this->password));

    $password_hash = password_hash($this->password, PASSWORD_BCRYPT);

    if ($stmt->execute([
      ":username" => $this->username,
      ":email" => $this->email,
      ":password" => $password_hash
    ])) {
      return true;
    } else {
      return false;
    }
  }

  function checkUser() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";

    $stmt = $this->db->prepare($query);

    $this->username = htmlspecialchars(strip_tags($this->username));

    $stmt->execute([
      ":username" => $this->username
    ]);

    $num = $stmt->rowCount();

    if ($num > 0) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id = $row['id'];
      $this->email = $row['email'];
      $this->password = $row['password'];

      return true;
    }

    return false;
  }
}
?>
