<?php
class Database {
  private $dbhost = "127.0.0.1";
  private $dbname = "bookmarks";
  private $dbuser = "root";
  private $dbpass = "";
  public $db;

  public function DB() {
    $this->db = null;

    try {
      $this->db = new PDO("mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname, $this->dbuser, $this->dbpass);
      session_start();
    } catch(PDOException $exception) {
      echo "Conenction Error: " . $exception->getMessage();
    }

    return $this->db;
  }
}
?>
