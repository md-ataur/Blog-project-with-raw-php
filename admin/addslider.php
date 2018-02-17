<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
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

 
    if ($title == "" || $link == "" ) {
        echo "<span class='error'>Fields must not be empty !</span>";   
    }elseif (empty($file_name)) {
        echo "<span class='error'> Please select image !</span>";
    }elseif ($file_size > 1048576) {
        echo "<span class='error'> Image size should be less than 1 MB !</span>";
    }elseif (in_array($file_ext, $permited) === false) {
        echo "<span class='error'> You can upload only:-".implode(', ', $permited). "</span>";
    }
    else{
        move_uploaded_file($file_temp, $upload_img);
        $query = "INSERT INTO tbl_slider(title, link, img) VALUES ('$title', '$link', '$upload_img')";
        $result = $db->insert($query);
        if($result){
            echo "<span class='success'>Successfully Added</span>";
        }else{
            echo "<span class='error'>Not Added</span>";
        }
    }
}

?>
        <div class="block">            
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Title..."  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Link</label>
                        </td>
                        <td>
                           <input type="text" name="link" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
    				<tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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