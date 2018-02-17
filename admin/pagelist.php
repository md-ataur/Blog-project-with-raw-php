<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php
        	if (isset($_GET['delid'])) {
			    $id = $_GET['delid'];
			    $delquery = "DELETE FROM tbl_page WHERE id='$id'";
			    $delpost = $db->delete($delquery);
			    if ($delpost) {
        			echo "<span class='success'>Successfully Deleted !</span>";
	        	}else{
	        		echo "<span class='error'>Not Deleted !</span>";
	        	}
			}
        	
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Page Title</th>
						<th>Content</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$query = "SELECT * FROM tbl_page";
						$getPage = $db->select($query); 
						if ($getPage) {
							$i = 0;
							while ($result = $getPage->fetch_assoc()) {
								$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i;?></td>
						<td><?php echo $result['name'];?></td>
						<td><?php echo $fm->textShorten($result['body'], 40);?></td>
						<td><a href="editpage.php?pageId=<?php echo $result['id'];?>">Edit</a> || <a href="?delid=<?php echo $result['id'];?>" onclick="return confirm('Are you sure to delete this !!');">Delete</a></td>
					</tr>
					<?php } }?>
					
				</tbody>
			</table>
    	</div>
    </div>
</div>
<?php include 'inc/footer.php';?>