<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    input[type="text"] {
    width: 396px;
    border: 1px solid #b3b3b3 !important;
}
</style>

<?php
if (isset($_GET['msgid'])) {
    $msgid = $_GET['msgid'];
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $to      = $fm->validation($_POST['toEmail']);
    $from    = $fm->validation($_POST['fromEmail']);
    $subject = $fm->validation($_POST['subject']);
    $message = $fm->validation($_POST['message']);

    $title   = mysqli_real_escape_string($db->link, $to);
    $from    = mysqli_real_escape_string($db->link, $from);
    $subject = mysqli_real_escape_string($db->link, $subject);
    $message = mysqli_real_escape_string($db->link, $message);


    $sendmail = mail($to, $subject, $message, $from);
    if($sendmail){
       echo "<span class='success'>Successfully Message Sent</span>";
    }else{
        echo "<span class='error'>Something wrong !</span>";
    }
}

?>
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
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $result['email']?>" name="toEmail"  />
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="text" name="fromEmail"  />
                        </td>
                    </tr>   
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text" name="subject"  />
                        </td>
                    </tr>       
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                           <textarea style='width:400px; height: 130px;' name="message"></textarea>
                        </td>
                    </tr>
    				<tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Send" />
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