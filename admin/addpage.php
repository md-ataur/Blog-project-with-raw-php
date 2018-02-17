<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $name   = mysqli_real_escape_string($db->link, $_POST['name']);
    $body   = mysqli_real_escape_string($db->link, $_POST['body']);
   
    if ($name == "" || $body == "" ) {
        echo "<span class='error'>Fields must not be empty !</span>";   
    }
    else{
        $query = "INSERT INTO tbl_page( name, body) VALUES ('$name', '$body')";
        $result = $db->insert($query);
        if($result){
            echo "<span class='success'>Successfully Inserted</span>";
        }else{
            echo "<span class='error'>Not Inserted</span>";
        }
    }
}

?>
    <div class="block">
        <table class="data display datatable" id="example">            
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name"  />
                        </td>
                    </tr>     
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                           <textarea class="tinymce" name="body"></textarea>
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