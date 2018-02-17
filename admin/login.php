<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Login.php');
	Session::checkLogin();
	$lg = new Login();

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

		<?php
			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$username = $_POST['username'];
				$password = md5($_POST['password']);
				$login = $lg->loginAccess($username, $password);
			}
		?>

		<form action="" method="post">
			<h1>Admin Login</h1>
			<?php
				if (isset($login)) {
					echo $login;
				}
			?>
			<div>
				<input type="text" placeholder="Username" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgetpass.php">Forgot Password</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>