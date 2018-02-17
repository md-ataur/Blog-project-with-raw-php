<?php 
	include 'lib/Database.php';
	include 'helpers/Format.php';
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'scripts/meta.php';?>
	<?php include 'scripts/css.php';?>
	<?php include 'scripts/js.php';?>
</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			 <?php 
	            $query = "SELECT * FROM title_slogan WHERE id='1'";
	            $getData = $db->select($query);
	            if ($getData) {
	                while ($result = $getData->fetch_assoc()) {

	        ?>        
			<div class="logo">
				<img src="admin/<?php echo $result['logo'];?>" alt="Logo"/>
				<h2><?php echo $result['title'];?></h2>
				<p><?php echo $result['slogan'];?></p>
			</div>
			<?php } }?>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php 
		            $query = "SELECT * FROM tbl_social WHERE id='1'";
		            $getData = $db->select($query);
		            if ($getData) {
		                while ($result = $getData->fetch_assoc()) {

		        ?>    
				<a href="<?php echo $result['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['twitter'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['linkedin'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['googleplus'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php } }?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php
		$page  = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($page, '.php');
	?>
	<ul>
		<li><a <?php if ($title == 'index') {echo 'id="active"';} ?>
			href="index.php">Home</a></li>
		 <?php 
	            $query = "SELECT * FROM tbl_page";
	            $getData = $db->select($query);
	            if ($getData) {
	                while ($result = $getData->fetch_assoc()) {
	    ?>     
		<li><a 
			<?php 
				if (isset($_GET['pageid']) && $_GET['pageid'] == $result['id']) {
					echo 'id="active"';
				}
			?>
			href="page.php?pageid=<?php echo $result['id'];?>"><?php echo $result['name'];?></a></li>	
		<?php } }?>
		<li><a <?php if ($title == 'contact') {echo 'id="active"';} ?> href="contact.php">Contact</a></li>
	</ul>
</div>
