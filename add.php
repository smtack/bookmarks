<?php
include_once "php/Database.php";
include_once "php/Category.php";

$database = new Database();
$newDB = $database->DB();

$category = new Category($newDB);
$categories = $category->readCategories();

$stmt = $categories->fetchAll();

if (isset($_POST['add'])) {
  include_once "php/Category.php";
  include_once "php/Bookmark.php";

  $category = new Category($newDB);
  $bookmark = new Bookmark($newDB);

  $bookmark->username = $_SESSION['username'];
  $bookmark->name = $_POST['name'];
  $bookmark->url = $_POST['url'];
  $bookmark->category = $_POST['category'];

  if ($bookmark->createBookmark()) {
    header("Location: home.php");
  } else {
    echo("Unable to create bookmark.");
  }
}
?>

<!doctype html>
<html>
	<head>
		<title>Bookmarks</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="css/index.css" type="text/css" rel="stylesheet">
	</head>

	<body id="index">
		<h1 id="logo">Bookmarks</h1>

		<div class="content">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<ul>
					<li>
						<label for="name">Name</label>
						<input type="text" name="name">
					</li>
					<li>
						<label for="url">URL</label>
						<input type="text" name="url">
					</li>
					<li>
						<label for="category">Category</label>
						<select name="category">
              <?php foreach ($stmt as $cat): ?>
			             <option value="<?php echo $cat['title']; ?>"><?php echo $cat['title']; ?></option>
               <?php endforeach; ?>
						</select>
					</li>
					<li>
						<input type="submit" name="add" value="Add">
					</li>
				</ul>
			</form>
		</div>

		<div class="footer">
			<p>By Sean Tack</p>
		</div>
	</body>
</html>
