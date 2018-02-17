<?php 
include 'inc/header.php';
?>
<?php
if (!isset($_GET['search']) or $_GET['search'] == NULL) {
	header("Location:404.php");
}else{
	$search = $_GET['search'];	
}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<?php
			$query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
			$getsearch = $db->select($query);
			if ($getsearch) {
				while ($result = $getsearch->fetch_assoc()) {	
		?>
		<div class="samepost clear">
			
			<h2><?php echo $result['title']?></h2>
			<h4><?php echo $fm->dateFormat($result['date']);?> By <a href="#"> <?php echo $result['author']?></a></h4>
			<img src="admin/<?php echo $result['image']?>" alt="post image"/>
			<?php echo $fm->textShorten($result['body']);?>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
			</div>
		</div>
		<?php } } else{ ?>
			<P> Your search query not found !!</p>	
		<?php }?> <!-- post while loop -->
	</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>