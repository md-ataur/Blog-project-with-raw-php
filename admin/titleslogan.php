<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        $title  = mysqli_real_escape_string($db->link, $_POST['title']);
        $slogan = mysqli_real_escape_string($db->link, $_POST['slogan']);
        
        $permited  = array('jpg', 'png', 'gif');
        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_temp = $_FILES['logo']['tmp_name'];
        
        $explode = explode('.', $file_name);
        $file_ext = strtolower(end($explode));
        $unique_image = 'logo'.'.'.$file_ext;
        $upload_img = "upload/".$unique_image;

        if ($title == "" || $slogan == "") {
            $msg = "<span class='error'>Fields must not be empty !</span>";   
        }elseif (!empty($file_name)) {
            if ($file_size > 1048576) {
                $msg = "<span class='error'> Image size should be less than 1 MB !</span>";
            }elseif (in_array($file_ext, $permited) === false) {
                $msg = "<span class='error'> You can upload only:-".implode(', ', $permited). "</span>";
            }else{
                move_uploaded_file($file_temp, $upload_img);
                $query = "UPDATE title_slogan 
                            SET 
                            title='$title', 
                            slogan='$slogan', 
                            logo='$upload_img'
                            WHERE id='1'";
                $result = $db->insert($query);
                if($result){
                    $msg = "<span class='success'>Successfully Updated</span>";
                }else{
                    $msg = "<span class='error'>Not Updated</span>";
                }
            }

        }else{
            $query = "UPDATE title_slogan 
                            SET 
                            title='$title', 
                            slogan='$slogan'
                            WHERE id='1'";
            $result = $db->insert($query);
            if($result){
                echo "<span class='success'>Successfully Updated</span>";
            }else{
                echo "<span class='error'>Not Updated</span>";
            }
        }
    }
?>
        <div class="block sloginblock">
        <?php 
            $query = "SELECT * FROM title_slogan WHERE id='1'";
            $getData = $db->select($query);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) {

        ?>               
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Website Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['title'];?>" name="title" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Website Slogan</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
                        </td>
                    </tr> 
                    <tr>
                        <td>
                        </td>
                        <td>
                           <img src="<?php echo $result['logo'];?> "/>
                        </td>
                        
                    </tr> 
                    
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="logo" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
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