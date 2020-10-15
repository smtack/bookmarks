<?php
if (isset($_POST['signup'])) {
  include_once "php/Database.php";
  include_once "php/User.php";

  $database = new Database();
  $newDB = $database->DB();

  $user = new User($newDB);

  $user->username = $_POST['username'];
  $user->email = $_POST['email'];
  $user->password = $_POST['password'];

	if ($user->signUp()) {
		$_SESSION['username'] = htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8');
		$_SESSION['loggedIn'] = 1;

    header("Location: home.php");
	} else {
		echo "Unable to sign up.";
	}
}

if (isset($_POST['login'])) {
  include_once "php/Database.php";
  include_once "php/User.php";

  $database = new Database();
  $newDB = $database->DB();

  $user = new User($newDB);

  $user->username = $_POST['username'];

  $checkUser = $user->checkUser();

  if ($checkUser && password_verify($_POST['password'], $user->password)) {
    $_SESSION['username'] = htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8');
		$_SESSION['loggedIn'] = 1;

    header("Location: home.php");
  } else {
    echo "Failed to log in.";
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
			<div class="toggle">
				<button id="signup">Sign Up</button>
				<button id="login">Log In</button>
			</div>

			<div class="forms">
				<div class="signup">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<ul>
							<li>
								<label for="username">Username</label>
								<input type="text" name="username">
							</li>
							<li>
								<label for="email">Email</label>
								<input type="email" name="email">
							</li>
							<li>
								<label for="password">Password</label>
								<input type="password" name="password">
							</li>
							<li>
								<input type="submit" name="signup" value="Sign Up">
							</li>
						</ul>
					</form>
				</div>

				<div class="login">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<ul>
							<li>
								<label for="username">Username</label>
								<input type="text" name="username">
							</li>
							<li>
								<label for="password">Password</label>
								<input type="password" name="password">
							</li>
							<li>
								<input type="submit" name="login" value="Log In">
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>

		<div class="footer">
			<p>By Sean Tack</p>
		</div>

		<script src="js/index.js"></script>
	</body>
</html>
