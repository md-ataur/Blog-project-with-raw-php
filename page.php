<?php 
include 'inc/header.php';
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		
		<?php 
			if (isset($_GET['pageid'])) {
				$id = $_GET['pageid'];
			}
            $query = "SELECT * FROM tbl_page WHERE id='$id'";
            $getData = $db->select($query);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) {

    	?>  
		<div class="about">   
			<h2><?php echo $result['name'];?></h2>

			<?php echo $result['body'];?>

		</div>
		<?php } }?>
	</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>