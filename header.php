<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
	<nav>
		<div  class="main-wrapper">
			<ul>
				<li><a href = "index.php"></a>Welcome To Our Website</li>
			</ul>
			<div class = "nav-login">
				<?php
					if (isset($_SESSION['u_id'])) {
						echo '<form action="includes/logoutt.php" method="POST">
								<button type="submit" name="submit">Logout</button>
								</form>';
					}else {
						echo '<form action="includes/loginn.php" method="POST">
								<input type = "text" name="uid" placeholder="Insert Your Username">
								<input type = "password" name="pwd" placeholder="Insert Your password">
								<button type = "submit" name="submit">Login</button>
								</form>
								<a href = "signup.php">Signup</a>';
						}
				?>
			</div>
		</div>
	</nav>
</header>