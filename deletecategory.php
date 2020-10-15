<?php
include_once "php/Database.php";
include_once "php/Category.php";

$id = isset($_GET['id']) ? $_GET['id'] : die("Missing ID");

$database = new Database();
$newDB = $database->DB();

$category = new Category($newDB);

$category->id = $id;

if ($category->deleteCategory()) {
	header("Location: home.php");
}
?>
