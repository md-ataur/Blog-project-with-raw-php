<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    $userid = Session::get('userId');
    $userrole = Session::get('userRole');
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User Profile</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $name      = $fm->validation($_POST['name']);
    $username  = $fm->validation($_POST['username']);
    $email     = $fm->validation($_POST['email']);
    $details   = $fm->validation($_POST['details']);
    
    $name      = mysqli_real_escape_string($db->link, $_POST['name']);
    $username  = mysqli_real_escape_string($db->link, $_POST['username']);
    $email     = mysqli_real_escape_string($db->link, $_POST['email']);
    $details   = mysqli_real_escape_string($db->link, $_POST['details']);

           
    if ($name == "" || $username == "" || $email == "" || $details == "") {
        echo "<span class='error'>Fields must not be empty !</span>";   
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "<span class='error'>Invalid email !</span>";
    }else{
        $query = "UPDATE tbl_user SET
                    name     = '$name',
                    username = '$username',
                    email    = '$email',
                    details  = '$details'
                    WHERE id='$userid'";
        $result = $db->update($query);
        if($result){
            echo "<span class='success'>Successfully User Updated</span>";
        }else{
            echo "<span class='error'>User Not Updated</span>";
        }
    }
}

?>

    <div class="block"> 
        <?php
            $query = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userrole'";
            $getData = $db->select($query);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) {
        
        ?>           
            <form action="" method="post">  
                <table class="form">
                    <tr>
                        <td width="10%">
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $result['username'];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" value="<?php echo $result['email'];?>"/>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea name="details" style="width:250px; height: 80px;"><?php echo $result['details'];?></textarea>
                        </td>
                    </tr>        
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php } }?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>