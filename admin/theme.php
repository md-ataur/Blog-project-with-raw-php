<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Theme</h2>
        <div class="block copyblock"> 
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $theme = $_POST['theme'];
                $query = "update tbl_theme set theme='$theme' where id='1'";
                $theme = $db->update($query);
                if ($theme) {
                    echo "<span class='success'>Successfully Changed</span>";
                }else{
                    echo "<span class='error'>Not Changed</span>";
                }
                
            }
        ?>
            <form action="" method="post">
                 <?php
                    $query  = "select * from tbl_theme where id='1'";
                    $result = $db->select($query);
                    while ($thm = $result->fetch_assoc()) { ?>
                        
                <table class="form">		
                    <tr>
                        <td>
                            <input <?php if ($thm['theme'] == 'default') {echo "checked";} ?>
                            type="radio" name="theme" value="default" class="medium" />Default
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input <?php if ($thm['theme'] == 'ash') {echo "checked";}?> type="radio" name="theme" value="ash" class="medium" />Ash
                        </td>
                    </tr>
    				<tr>
                        <td>
                            <input type="submit" name="submit" Value="Change" />
                        </td>
                    </tr>   
                    
                </table>
                <?php }?> 
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>