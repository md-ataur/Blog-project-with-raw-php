<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (isset($_GET['slideId'])) {
    $slideId = $_GET['slideId'];
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Post</h2>
        
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])) {
    $title  = $fm->validation($_POST['title']);
    $link   = $fm->validation($_POST['link']);

    $title  = mysqli_real_escape_string($db->link, $title);
    $link   = mysqli_real_escape_string($db->link, $link);

    $permited  = array('jpg', 'jpeg', 'png', 'gif' );
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    $explode = explode('.', $file_name);
    $file_ext = strtolower(end($explode));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $upload_img = "upload/slider/".$unique_image;
 
    if ($title == "" || $link == "") {
        $msg = "<span class='error'>Fields must not be empty !</span>";   
    }elseif (!empty($file_name)) {
        if ($file_size > 1048576) {
            $msg = "<span class='error'> Image size should be less than 1 MB !</span>";
        }elseif (in_array($file_ext, $permited) === false) {
            $msg = "<span class='error'> You can upload only:-".implode(', ', $permited). "</span>";
        }else{
            move_uploaded_file($file_temp, $upload_img);
            $query = "UPDATE tbl_slider 
                        SET 
                        title  ='$title', 
                        link   ='$link',
                        img    = '$upload_img'
                        WHERE id='$slideId'";
            $result = $db->insert($query);
            if($result){
               echo "<span class='success'>Successfully Updated</span>";
                
            }else{
                echo "<span class='error'>Not Updated</span>";
            }
        }

    }else{
        $query = "UPDATE tbl_slider 
                    SET 
                    title  ='$title', 
                    link   ='$link'
                    WHERE id='$slideId'";
        $result = $db->insert($query);
        if($result){
            echo "<span class='success'>Successfully Updated</span>";
        }else{
            echo "<span class='error'>Not Updated</span>";
        }
    }
}

?>
<div class="block"> 
    <?php
        $query = "SELECT * FROM tbl_slider WHERE id=$slideId";
        $getData = $db->select($query);
        if ($getData) {
            while ($result = $getData->fetch_assoc()) {
    ?>                       
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $result['title']?>" />
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <label>Link</label>
                        </td>
                        <td>
                           <input type="text" value="<?php echo $result['link']?>" name="link" />
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $result['img']?>" width="80" height="60"><br/>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="update" Value="Update" />
                        </td>
                    </tr>
                </table>

            </form>
            <?php } }?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php';?>