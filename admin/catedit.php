<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM tbl_category WHERE id='$id'";
        $catRead = $db->select($query)->fetch_assoc();

    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
       <div class="block copyblock"> 
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['submit'])) {
                $name = $_POST['name'];
                $userid = $_POST['userid'];
                if ($name == "") {
                    echo "<span class='error'>Please Field the field</span>";
                } else{
                    $query = "UPDATE tbl_category SET name ='$name', userid ='$userid' WHERE id='$id'";
                    $update = $db->update($query );
                    if ($update) {
                       echo "<script>window.location='catlist.php'</script>";
                    }else{
                        echo "<span class='error'>No updated !</span>";
                    }
                }
            }
        ?>
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" value="<?php echo $catRead['name']?>" class="medium" />
                        </td>
                    </tr>
    				<tr> 
                        <td>
                            <input type="hidden" name="userid" value="<?php echo Session::get("userId");?>" />
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>