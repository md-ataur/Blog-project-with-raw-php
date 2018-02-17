<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (isset($_GET['postId'])) {
    $postid = $_GET['postId'];
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Post</h2>
        
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])) {
    $title  = $fm->validation($_POST['title']);
    $cat    = $fm->validation($_POST['cat']);
    $author = $fm->validation($_POST['author']);
    $tags   = $fm->validation($_POST['tags']);
    $body   = $fm->validation($_POST['body']);
    $userid = $fm->validation($_POST['userid']);

    $title  = mysqli_real_escape_string($db->link, $_POST['title']);
    $cat    = mysqli_real_escape_string($db->link, $_POST['cat']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $tags   = mysqli_real_escape_string($db->link, $_POST['tags']);
    $body   = mysqli_real_escape_string($db->link, $_POST['body']);
    $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

    $permited  = array('jpg', 'jpeg', 'png', 'gif' );
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    
    $explode = explode('.', $file_name);
    $file_ext = strtolower(end($explode));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $upload_img = "upload/".$unique_image;

 
    if ($title == "" || $cat == "" || $author == "" || $tags == "" || $body == "") {
        $msg = "<span class='error'>Fields must not be empty !</span>";   
    }elseif (!empty($file_name)) {
        if ($file_size > 1048576) {
            $msg = "<span class='error'> Image size should be less than 1 MB !</span>";
        }elseif (in_array($file_ext, $permited) === false) {
            $msg = "<span class='error'> You can upload only:-".implode(', ', $permited). "</span>";
        }else{
            move_uploaded_file($file_temp, $upload_img);
            $query = "UPDATE tbl_post 
                        SET 
                        cat    ='$cat', 
                        title  ='$title', 
                        body   ='$body', 
                        image  ='$upload_img', 
                        author ='$author', 
                        tags   ='$tags',
                        userid ='$userid' 
                        WHERE id='$postid'";
            $result = $db->insert($query);
            if($result){
               echo "<span class='success'>Successfully Updated</span>";
                
            }else{
                echo "<span class='error'>Not Updated</span>";
            }
        }

    }else{
        $query = "UPDATE tbl_post 
                    SET 
                    cat     ='$cat', 
                    title   ='$title', 
                    body    ='$body', 
                    author  ='$author', 
                    tags    ='$tags',
                    userid  ='$userid' 
                    WHERE id='$postid'";
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
        $query = "SELECT * FROM tbl_post WHERE id=$postid";
        $getPost = $db->select($query);
        if ($getPost) {
            while ($result = $getPost->fetch_assoc()) {
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
                            <label>Category</label>
                        </td>
                        <td>                            
                            <select id="select" name="cat">
                                <option value="">Select</option>
                                <?php
                                    $query = "SELECT * FROM tbl_category";
                                    $getCat = $db->select($query);
                                    if ($getCat) {
                                        while ($cat = $getCat->fetch_assoc()) {
                                ?>
                                <option 
                                    <?php
                                        if ($result['cat'] == $cat['id']) { ?>
                                            selected="selected"
                                    <?php } ?> value="<?php echo $cat['id']?>"><?php echo $cat['name']?>    
                                </option>
                                <?php } }?> 
                            </select> 
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                           <input type="text" value="<?php echo Session::get("userName");?>" name="author" />
                           <input type="hidden" name="userid" value="<?php echo Session::get("userId");?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                           <input type="text" value="<?php echo $result['tags']?>" name="tags" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                           <textarea class="tinymce" name="body"><?php echo $result['body']?></textarea>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $result['image']?>" width="80" height="60"><br/>
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