<?php
if (isset($_POST['addCategory'])) {
  include_once "php/Database.php";
  include_once "php/Category.php";

  $database = new Database();
  $newDB = $database->DB();

  $category = new Category($newDB);

  $category->username = $_SESSION['username'];
  $category->title = $_POST['category'];

  if ($category->createCategory()) {
    header("Location: home.php");
  } else {
    echo "Unable to create category.";
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
						<label for="category">Category</label>
						<input type="text" name="category">
					</li>
					<li>
						<input type="submit" name="addCategory" value="Add">
					</li>
				</ul>
			</form>
		</div>

		<div class="footer">
			<p>By Sean Tack</p>
		</div>
	</body>
</html>
