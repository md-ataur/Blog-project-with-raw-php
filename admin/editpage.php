<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (isset($_GET['pageId'])) {
    $pageId = $_GET['pageId'];
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit page</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $name   = mysqli_real_escape_string($db->link, $_POST['name']);
    $body   = mysqli_real_escape_string($db->link, $_POST['body']);
   
    if ($name == "" || $body == "" ) {
        $msg = "<span class='error'>Fields must not be empty !</span>";   
    }
    else{
        $query = "UPDATE tbl_page SET name='$name', body='$body' WHERE id='$pageId'";
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
        <table class="data display datatable" id="example"> 
        <?php
            $query = "SELECT * FROM tbl_page WHERE id='$pageId'";
            $getPage = $db->select($query);
            if ($getPage) {
                while ($result = $getPage->fetch_assoc()) {
        ?>             
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name']?>"  />
                        </td>
                    </tr>     
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                           <textarea class="tinymce" name="body"><?php echo $result['body']?> </textarea>
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