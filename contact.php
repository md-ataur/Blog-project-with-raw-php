<?php 
include 'inc/header.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
	$firstname	= $fm->validation($_POST['firstname']);
    $lastname	= $fm->validation($_POST['lastname']);
    $email 		= $fm->validation($_POST['email']);
    $body		= $fm->validation($_POST['body']);

    $firstname  = mysqli_real_escape_string($db->link, $_POST['firstname']);
    $lastname   = mysqli_real_escape_string($db->link, $_POST['lastname']);
    $email 		= mysqli_real_escape_string($db->link, $_POST['email']);
    $body   	= mysqli_real_escape_string($db->link, $_POST['body']);

    $chkquery = "SELECT email FROM tbl_contact WHERE email = '$email'";
    $chkemail = $db->select($chkquery);

    if ($firstname == "" || $lastname == "" || $email == "" || $body == "" ) {
        $msg = "<span class='error'>Fields must not be empty !</span>";   
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $msg = "<span class='error'> The email address is not valid !</span>";
    }elseif ($chkemail != false) {
    	$msg = "<span class='error'> Already email exists !</span>";
    }
    else{
        $query = "INSERT INTO tbl_contact( firstname, lastname, email, body) VALUES ('$firstname', '$lastname', '$email', '$body')";
        $result = $db->insert($query);
        if($result){
            $msg = "<span class='success'>Successfully Your email send</span>";
        }else{
            $msg = "<span class='error'>Not send</span>";
        }
    }

}	
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if (isset($msg)) {
						echo $msg;
					}
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>First Name:</td>
					<td>
						<input type="text" name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td>
						<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Email Address:</td>
					<td>
						<input type="email" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Message:</td>
					<td>
						<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>
</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>