<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css">

<?php
    $query  = "select * from tbl_theme where id='1'";
    $result = $db->select($query);
    while ($theme = $result->fetch_assoc()) { 
    	if ($theme['theme'] == 'default') { ?>
    		<link rel="stylesheet" href="theme/default.css">
    <?php } elseif ($theme['theme'] == 'ash') { ?>
    	<link rel="stylesheet" href="theme/ash.css">
    <?php } ?> 

<?php } ?>

  