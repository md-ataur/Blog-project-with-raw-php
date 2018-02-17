<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	Session::checkLogin();
	$db = new Database();
	$fm = new Format();
?>	
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Recovery Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$email = $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link, $_POST['email']);

				if (empty($email)) {
					echo "<span style='color:red; margin:0 0 10px; display: block;'> Please fill the field !</span>";
				}elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
					echo "<span style='color:red; margin:0 0 10px; display: block;'> Invalid Email Address !</span>";
				}else{
					$chkquery = "SELECT * FROM tbl_user WHERE email='$email' limit 1";
					$chkemail = $db->select($chkquery);
					if ($chkemail != false) {
						while ($data = $chkemail->fetch_assoc()) {
							$userId 	= $data['id'];
							$userName 	= $data['username'];
						}

						/* new password create */
						$text = substr($email, 0, 4);
						$rand = rand(10000, 99999);
						$newpass = "$text$rand";
						$password = md5($newpass);

						
						/* new password update in the db table*/
						$query = "UPDATE tbl_user 
									SET
									password = '$password'
									WHERE id = '$userId'";
						$result = $db->update($query);


						/* new password send to user by email */
						$to 	  = $email;
						$from 	  = "appointbd@gmail.com";
						$headers  = "From: $from\r\n";
						$headers .= 'MIME-Version: 1.0" . "\r\n';
						$headers .= 'Content-type: text/html; charset=UTF-8" . "\r\n';
						$subject  = "Your password";
						$message  = "Your username is ".$userName." And Password is ".$newpass;

						$sendmail = mail($to, $subject, $message, $headers);
						if ($sendmail) {
							echo "<span style='color:green; margin:0 0 10px; display: block;'>Please check your email</span>";
						}else{
							echo "<span style='color:red; margin:0 0 10px; display: block;'>Email not send </span>";
						}



					}else{
						echo "<span style='color:red; margin:0 0 10px; display: block;'>Email Address Not Exist !</span>";
					}
				}
			}


		?>
		<form action="" method="post">
			<h1>Recovery Password</h1>
			<div>
				<input type="text" placeholder="Enter your valid email" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>