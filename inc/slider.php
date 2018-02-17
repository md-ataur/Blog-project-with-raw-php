   
<div class="slidersection templete clear">
    <div id="slider">
    	<?php
		    $query = "SELECT * FROM tbl_slider";
		    $getData = $db->select($query);
		    if ($getData) {
		        while ($result = $getData->fetch_assoc()) {
		?> 
        <a target="__blank" href="<?php echo $result['link']?>"><img src="admin/<?php echo $result['img']?>" alt="nature 1" title="<?php echo $result['title']?>" /></a>
        <?php } }?>
    </div>
</div>

