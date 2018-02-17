<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Categories</h2>
			<ul>
				<?php
					$query = "SELECT * FROM tbl_category";
					$category = $db->select($query);

					if ($category) {
						while ($result = $category->fetch_assoc()) {
				?>
				<li><a href="posts.php?catId=<?php echo $result['id']?>"><?php echo $result['name'];?></a></li>
				<?php } } else { echo "Category not found ";}?>
								
			</ul>
	</div>

	<div class="samesidebar clear">
		<h2>Latest articles</h2>
		<?php 
			$query = "select * from tbl_post limit 5"; 
			$latestpost = $db->select($query);
			if ($latestpost) {
				while ($post = $latestpost->fetch_assoc()) {
		?>	
		<div class="popular clear">
			<h3><a href="post.php?id=<?php echo $post['id']?>"><?php echo $post['title']?></a></h3>
			<a href="post.php?id=<?php echo $post['id']?>"><img src="admin/<?php echo $post['image']?>" alt="post image"/></a>
			<?php echo $fm->textShorten($post['body'], 60);?>
		</div>
		<?php } } else{
			echo "<script>window.location='404.php'</script>";
		}?>
		
		
	</div>
</div>