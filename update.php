<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('Missing ID');

include_once "php/Database.php";
include_once "php/Category.php";
include_once "php/Bookmark.php";

$database = new Database();
$newDB = $database->DB();

$category = new Category($newDB);
$categories = $category->readCategories();

$bookmark = new Bookmark($newDB);

$bookmark->id = $id;

if ($_POST) {
  $bookmark->name = $_POST['name'];
  $bookmark->url = $_POST['url'];
  $bookmark->category = $_POST['category'];

  if ($bookmark->updateBookmark()) {
    header("Location: home.php");
  } else {
    echo("Unable to update bookmark.");
  }
}

$bookmark->readOneBookmark();

$stmt = $categories->fetchAll();
?>

<!doctype html>
<html>
	<head>
		<title>Bookmarks - Update</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="css/index.css" type="text/css" rel="stylesheet">
	</head>

	<body id="index">
		<h1 id="logo">Bookmarks</h1>

		<div class="content">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?id={$id}"); ?>" method="post">
				<ul>
					<li>
						<label for="name">Name</label>
						<input type="text" name="name" value="<?php echo $bookmark->name; ?>">
					</li>
					<li>
						<label for="url">URL</label>
						<input type="text" name="url" value="<?php echo $bookmark->url; ?>">
					</li>
					<li>
						<label for="category">Category</label>
						<select name="category" value="<?php echo $bookmark->category; ?>">
							<?php foreach ($stmt as $cat): ?>
								<option value="<?php echo $cat['title']; ?>"<?php if ($bookmark->category == $cat['title']) echo 'selected="selected"'; ?>><?php echo $cat['title']; ?></option>
							<?php endforeach; ?>
						</select>
					</li>
					<li>
						<input type="submit" name="update" value="Update">
					</li>
				</ul>
			</form>
		</div>

		<div class="footer">
			<p>By Sean Tack</p>
		</div>
	</body>
</html>
