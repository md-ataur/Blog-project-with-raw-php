<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
                $copyright   = mysqli_real_escape_string($db->link, $_POST['copyright']);
                    
                if ($copyright == "") {
                    $msg = "<span class='error'>Fields must not be empty !</span>";   
                }else{
                    $query = "UPDATE tbl_copyright 
                                    SET 
                                    copyright   ='$copyright'                          
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

        <div class="block copyblock"> 
        <?php 
            $query = "SELECT * FROM tbl_copyright WHERE id='1'";
            $getData = $db->select($query);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) {

        ?>       
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $result['copyright'];?>"  name="copyright" class="large" />
                        </td>
                    </tr>
    				
    				 <tr> 
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