<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (!Session::get("userRole") == '0') {
    echo "<script>window.location='index.php'</script>";
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add User</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $username  = $fm->validation($_POST['username']);
    $password  = $fm->validation(md5($_POST['password']));
    $email     = $fm->validation($_POST['email']);
    $role      = $fm->validation($_POST['role']);
    
    $username  = mysqli_real_escape_string($db->link, $_POST['username']);
    $password  = mysqli_real_escape_string($db->link, md5($_POST['password']));
    $email     = mysqli_real_escape_string($db->link, $_POST['email']);
    $role      = mysqli_real_escape_string($db->link, $_POST['role']);
    
    if ($username == "" || $password == "" || $role == "" || $email == "") {
        echo "<span class='error'>Fields must not be empty !</span>";   
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "<span class='error'>Invalid email !</span>"; 
    }else{

        $chkquery = "SELECT email FROM tbl_user WHERE email='$email' limit 1";
        $chkemail = $db->select($chkquery);
        if ($chkemail == true) {
            echo "<span class='error'>Email already exists !</span>";
        }else{

            $query = "INSERT INTO tbl_user(username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
            $result = $db->insert($query);
            if($result){
                echo "<span class='success'>Successfully User Added</span>";
            }else{
                echo "<span class='error'>User Not Added</span>";
            }
        }    
    }
}

?>
        <div class="block">            
            <form action="" method="post" >
                <table class="form">
                    <tr>
                        <td width="10%">
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="password" name="password" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>User Role</label>
                        </td>
                        <td>                            
                            <select id="select" name="role">
                                <option value="">Select User Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Author</option>
                                <option value="3">Editor</option>
                            </select>
                        </td>
                    </tr>                    
    				<tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>