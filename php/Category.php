<?php
class Category {
  private $db;
  private $table_name = "categories";

  public $id;
  public $username;
  public $title;

  public function __construct($newDB) {
    $this->db = $newDB;
  }

  function createCategory() {
    $query = "INSERT INTO " . $this->table_name . " (username, title) VALUES (:username, :title)";

    $stmt = $this->db->prepare($query);

    $this->username = htmlspecialchars(strip_tags($_SESSION['username']));
    $this->title = htmlspecialchars(strip_tags($this->title));

    if ($stmt->execute([
      ":username" => $this->username,
      ":title" => $this->title
    ])) {
      return true;
    } else {
      return false;
    }
  }

  function readCategories() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username ORDER BY id DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ":username" => $_SESSION['username']
    ]);

    return $stmt;
  }

  function deleteCategory() {
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

    $stmt = $this->db->prepare($query);

    if ($stmt->execute([
      ":id" => $this->id
    ])) {
      return true;
    } else {
      return false;
    }
  }
}
?>
