<?php 
include 'inc/header.php';
?>
<?php
if (isset($_GET['catId'])) {
	$id = $_GET['catId'];
}
?>	

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<?php 
			$query = "SELECT * FROM tbl_post where cat = $id";
			$getpost = $db->select($query);
			if ($getpost) {
				while ($post = $getpost->fetch_assoc()) {
		?> 
		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $post['id']?>"><?php echo $post['title']?></a></h2>
			<h4><?php echo $fm->dateFormat($post['date']);?>, By <a href="#"><?php echo $post['author']?></a></h4>
			<a href="#"><img src="admin/<?php echo $post['image']?>" alt="post image"/></a>
			<?php echo $fm->textShorten($post['body']);?>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $post['id'];?>">Read More</a>
			</div>
		</div>
		<?php } } else {header("Location:404.php");}?>
	
	</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>		