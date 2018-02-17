<?PHP
	if (isset($_GET['pageid'])) {
		$pageid = $_GET['pageid'];
		$query = "SELECT * FROM tbl_page WHERE id='$pageid'";
            $getData = $db->select($query);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) { 
                	$title = $result['name']; ?>
                <title><?php echo $title;?> || <?php echo TITLE;?></title>
                
       <?php } } } elseif (isset($_GET['id'])) {
		$postid = $_GET['id'];
		$query = "SELECT * FROM tbl_post WHERE id='$postid'";
            $getData = $db->select($query);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) 
                	$title = $result['title']; { ?>
                <title><?php echo $title;?> || <?php echo TITLE;?></title>
       <?php } } }  else { ?>
            <title><?php echo $fm->title();?> || <?php echo TITLE;?> </title>
       <?php } ?>

	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
<?php
if (isset($_GET['id'])) {
	$keyid = $_GET['id'];
	$query = "SELECT * FROM tbl_post WHERE id='$keyid'";
    $tagsData = $db->select($query);
        if ($tagsData) {
            while ($result = $tagsData->fetch_assoc()) {?>
       	<meta name="keywords" content="<?php echo $result['tags'];?>">
    <?php } } } else {?>
    	<meta name="keywords" content="<?php echo KEYWORD;?>">
    <?php }?>
	<meta name="keywords" content="blog,cms blog">