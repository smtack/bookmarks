<?php
$id = isset($_GET['id']) ? $_GET['id'] : die("Missing ID");

include_once "php/Database.php";
include_once "php/Bookmark.php";

$database = new Database();
$newDB = $database->DB();

$bookmark = new Bookmark($newDB);
$bookmark->id = $id;

if ($bookmark->deleteBookmark()) {
	header("Location: home.php");
} else {
	echo("Unable to delete bookmark.");
}
?>
