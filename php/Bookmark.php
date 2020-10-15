<?php
class Bookmark {
  private $db;
  private $table_name = "bookmarks";

  public $id;
  public $username;
  public $name;
  public $url;
  public $category;

  public function __construct($newDB) {
    $this->db = $newDB;
  }

  function createBookmark() {
    $query = "INSERT INTO " . $this->table_name . " (username, name, url, category) VALUES (:username, :name, :url, :category)";

    $stmt = $this->db->prepare($query);

    $this->username = htmlspecialchars(strip_tags($_SESSION['username']));
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->url = htmlspecialchars(strip_tags($this->url));
    $this->category = htmlspecialchars(strip_tags($this->category));

    if ($stmt->execute([
      ":username" => $this->username,
      ":name" => $this->name,
      ":url" => $this->url,
      ":category" => $this->category
    ])) {
      return true;
    } else {
      return false;
    }
  }

  function readBookmarks() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username ORDER BY id DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ":username" => $_SESSION['username']
    ]);

    return $stmt;
  }

  function readOneBookmark() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";

    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ":id" => $this->id
    ]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name = $row['name'];
    $this->url = $row['url'];
    $this->category = $row['category'];
  }

  function updateBookmark() {
    $query = "UPDATE " . $this->table_name . " SET name = :name, url = :url, category = :category WHERE id = :id";

    $stmt = $this->db->prepare($query);

    $this->id = htmlspecialchars($this->id);
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->url = htmlspecialchars(strip_tags($this->url));
    $this->category = htmlspecialchars(strip_tags($this->category));

    if ($stmt->execute([
      ":name" => $this->name,
      ":url" => $this->url,
      ":category" => $this->category,
      ":id" => $this->id
    ])) {
      return true;
    }

    return false;
  }

  function deleteBookmark() {
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
