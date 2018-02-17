<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $query = "DELETE FROM tbl_user WHERE id='$id'";
    $result = $db->delete($query);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php
            if (isset($result)) {
                echo "<span class='success'>Successfully Deleted</span>";
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
    			<thead>
    				<tr>
    					<th>No.</th>
    					<th>Name</th>
    					<th>Username</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
    				</tr>
    			</thead>
    			<tbody>
                    <?php
                        $query = "SELECT * FROM tbl_user";
                        $getData = $db->select($query);
                        if ($getData) {
                            $i = 0;
                            while ($result = $getData->fetch_assoc()) {
                                $i++;
                    ?>
    				<tr class="odd gradeX">
    					<td><?php echo $i;?></td>
    					<td><?php echo $result['name'];?></td>
                        <td><?php echo $result['username'];?></td>
                        <td><?php echo $result['email'];?></td>
                        <td><?php echo $fm->textShorten($result['details'], 100);?></td>
                        <td>
                            <?php
                                if ($result['role'] == '0') {
                                    echo "Admin";
                                }elseif ($result['role'] == '1') {
                                    echo "Author";
                                }elseif ($result['role'] == '2') {
                                    echo "Editor";
                                }
                            ?>
                                
                            </td>
    					<td>
                            <a href="userview.php?userid=<?php echo $result['id']?>">View</a> 
                            <?php if (Session::get("userRole") == '0') { ?>
                            || <a href="?delid=<?php echo $result['id']?>" onclick="return confirm('are you sure to delete ?')">Delete</a>
                            <?php }?>
                        </td>
    				</tr>
                    <?php } }?>
    				
    			</tbody>
    		</table>
       </div>
    </div>
</div>
<?php include 'inc/footer.php';?>