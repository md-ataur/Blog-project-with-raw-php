<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php
        	if (isset($_GET['delid'])) {
			    $id = $_GET['delid'];

			    $query = "SELECT * FROM tbl_post WHERE id='$id'";
			    $getData = $db->select($query);
			    if ($getData) {
			    	while ($delimg = $getData->fetch_assoc()) {
			    		$dellink = $delimg['image'];
			    		unlink($dellink);
			    	}
			    }

			    $delquery = "DELETE FROM tbl_post WHERE id='$id'";
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
						<th>Post Title</th>
						<th>Category</th>
						<th>Content</th>
						<th>Image</th>
						<th>Author</th>
						<th>Tags</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$query = "SELECT tbl_post.*, tbl_category.name
									FROM tbl_post
									INNER JOIN tbl_category
									ON tbl_post.cat = tbl_category.id
									ORDER BY id DESC";

									/*"SELECT p.*, c.name
									FROM tbl_post AS p, tbl_category AS c
									WHERE p.cat = c.id
									";*/

						$getPost = $db->select($query); 
						if ($getPost) {
							$i = 0;
							while ($result = $getPost->fetch_assoc()) {
								$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i;?></td>
						<td><?php echo $result['title'];?></td>
						<td><?php echo $result['name'];?></td>
						<td><?php echo $fm->textShorten($result['body'], 40);?></td>
						<td><img src="<?php echo $result['image'];?>"></td>
						<td><?php echo $result['author'];?></td>
						<td><?php echo $result['tags'];?></td>
						<td><?php echo $result['date'];?></td>
						<td>
<?php 
	if (Session::get("userId") == $result['userid'] || Session::get("userRole") == '0') { ?>
		<a href="editpost.php?postId=<?php echo $result['id'];?>">Edit</a> ||
		<a href="?delid=<?php echo $result['id'];?>" onclick="return confirm('Are you sure to delete this post !!');">Delete</a>
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