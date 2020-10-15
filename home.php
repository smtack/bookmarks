<?php
include_once "php/Database.php";
include_once "php/Category.php";
include_once "php/Bookmark.php";
include_once "php/User.php";

$database = new Database();
$newDB = $database->DB();

$category = new Category($newDB);
$bookmark = new Bookmark($newDB);

$categories = $category->readCategories();
$bookmarks = $bookmark->readBookmarks();

$stmt = $categories->fetchAll();
$get_bookmarks = $bookmarks->fetchAll();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Bookmarks</title>

	<link href="css/main.css" type="text/css" rel="stylesheet">
</head>

<body id="index">
	<div class="sidebar">
		<h1>Bookmarks</h1>

		<p class="add"><a href="addcategory.php">Add Category</a></p>
		<p class="add"><a href="add.php">Add New</a></p>

		<ul>
			<?php foreach ($stmt as $cat): ?>
				<li><a href='#<?php echo $cat['title']; ?>'><?php echo $cat['title']; ?></a></li>
			<?php endforeach; ?>
		</ul>

		<p class="logout"><a href="logout.php">Logout</a></p>
	</div>

	<div class="sidebartoggle">
		<img src="img/menu.svg">
	</div>

	<div class="content">
		<div class="boxes">
			<?php foreach ($stmt as $cat): ?>
			<div class='box'>
				<h2 id='{$title}'><?php echo $cat['title']; ?>
					<a href="deletecategory.php?id=<?php echo $cat['id']; ?>"><img id="deleteBox" src="img/deletered.png"></a>
				</h2>

				<ul>
					<?php foreach ($get_bookmarks as $bm): ?>
						<?php if ($bm['category'] == $cat['title']): ?>
							<span class="bookmark">
								<li>
									<a class="bookmarktitle" href="<?php echo $bm['url']; ?>"><?php echo $bm['name']; ?></a>
									<a class="update" href="update.php?id=<?php echo $bm['id']; ?>"><img src="img/update.png"></a>
									<a class="delete" href="delete.php?id=<?php echo $bm['id']; ?>"><img src="img/delete.png"></a>
								</li>
							</span>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="footer">
			<p>By Sean Tack</p>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
