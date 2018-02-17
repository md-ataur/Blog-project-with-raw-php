<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $query = "DELETE FROM tbl_category WHERE id='$id'";
    $result = $db->delete($query);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
            if (isset($result)) {
                echo "<span class='success'>Successfully Deleted</span>";
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
    			<thead>
    				<tr>
    					<th>Serial No.</th>
    					<th>Category Name</th>
    					<th>Action</th>
    				</tr>
    			</thead>
    			<tbody>
                    <?php
                        $query = "SELECT * FROM tbl_category";
                        $getCat = $db->select($query);
                        if ($getCat) {
                            $i = 0;
                            while ($result = $getCat->fetch_assoc()) {
                                $i++;
                    ?>
    				<tr class="odd gradeX">
    					<td><?php echo $i;?></td>
    					<td><?php echo $result['name']?></td>
    					<td>
                            
<?php 
    if (Session::get("userId") == $result['userid'] || Session::get("userRole") == '0') { ?>
        <a href="catedit.php?id=<?php echo $result['id'];?>">Edit</a> ||
        <a href="?delid=<?php echo $result['id'];?>" onclick="return confirm('Are you sure to delete this !!');">Delete</a>
<?php } ?>

                        </td>
    				</tr>
                    <?php } }?>
    				
    			</tbody>
    		</table>
       </div>
    </div>
</div>
<?php include 'inc/footer.php';?>