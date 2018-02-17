<?php 
include 'inc/header.php';
?>
<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "select * from tbl_post where id = $id";
	$getpost = $db->select($query);
}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<?php
				if ($getpost) {
					while ($result = $getpost->fetch_assoc()) {	
			?>
			<h2><?php echo $result['title']?></h2>
			<h4><?php echo $fm->dateFormat($result['date']);?> By <a href="#"> <?php echo $result['author']?></a></h4>
			<img src="admin/<?php echo $result['image']?>" alt="post image"/>
			<?php echo $result['body']?> <!-- post article -->

<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://myblog-lckvwuiphy.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
</noscript>

			<div class="relatedpost clear">
				<h2>Related articles</h2>
				<?php 
					$relid = $result['cat'];
					$query = "select * from tbl_post where cat='$relid' limit 6"; 
					$relpost = $db->select($query);
					if ($relpost) {
						while ($post = $relpost->fetch_assoc()) {
				?>	
				<a href="post.php?id=<?php echo $post['id']?>"><img src="admin/<?php echo $post['image']?>" alt="post image"/></a>
				<?php } } else { echo "No related post here!"; }?>
			</div> <!-- related post while loop -->


			<?php } } else{
				echo "<script>window.location='404.php'</script>";
			}?> <!-- post while loop -->
		</div>
	</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>