<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (isset($_GET['msgid'])) {
    $msgid = $_GET['msgid'];
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    echo "<script>window.location='inbox.php'</script>";
}

?>
<style type="text/css">
    input[type="text"] {
    width: 396px;
    border: 1px solid #b3b3b3 !important;
}
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>
        <div class="block">
         <table class="data display datatable" id="example"> 
         <?php
            $query = "SELECT * FROM tbl_contact WHERE id='$msgid'";
            $getPage = $db->select($query);
            if ($getPage) {
                while ($result = $getPage->fetch_assoc()) {
        ?>             
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td width="10%">
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname'];?>"  />
                        </td>
                    </tr>   
                     <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $result['email']?>"  />
                        </td>
                    </tr>     
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                           <textarea style='width:400px; height: 130px;' readonly><?php echo $result['body']?> </textarea>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $fm->dateFormat($result['date']);?>"  />
                        </td>
                    </tr>   
    				<tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="ok" />
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