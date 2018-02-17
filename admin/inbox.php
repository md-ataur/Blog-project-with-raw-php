<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
<?php
if (isset($_GET['seenid'])) {
    $seenid = $_GET['seenid'];
    $query = "UPDATE tbl_contact SET status='1' WHERE id='$seenid'";
    $update = $db->update($query);
    if($update){
       echo "<span class='success'>Message sent in the seen box</span>";
    }else{
        echo "<span class='error'>Something wrong !</span>";
    }
}
?>
        <div class="block">        
            <table class="data display datatable" id="example">
    			<thead>
    				<tr>
    					<th>NO</th>
    					<th>Name</th>
    					<th>E-mail</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
    				</tr>
    			</thead>
    			<tbody>
                    <?php
                        $query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";
                        $getData = $db->select($query);
                        if ($getData) {
                            $i = 0;
                            while ($result = $getData->fetch_assoc()) {
                                $i++;
                    ?>
    				<tr class="odd gradeX">
    					<td><?php echo $i;?></td>
    					<td><?php echo $result['firstname'] .'&nbsp;'.$result['lastname'];?></td>
                        <td><?php echo $result['email'];?></td>
                        <td><?php echo $fm->textShorten($result['body'], 100);?></td>
                        <td><?php echo $fm->dateFormat($result['date']);?></td>
    					<td>
                            <a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
                            <a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> ||
                            <a onclick="return confirm('Are you sure to move the msg !');" href="?seenid=<?php echo $result['id']; ?>">Seen</a> 
                        </td>
    				</tr>	
                    <?php } }?>
    			</tbody>
    		</table>
       </div>
    </div>

     <div class="box round first grid">
        <h2>Seen Message</h2>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $query = "DELETE FROM tbl_contact WHERE status='1' AND id='$delid'";
    $deldata = $db->delete($query);
    if($deldata){
       echo "<span class='success'>Message Successfully Deleted</span>";
    }else{
        echo "<span class='error'>Something wrong !</span>";
    }
}
?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";
                        $seenData = $db->select($query);
                        if ($seenData) {
                            $i = 0;
                            while ($result = $seenData->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['firstname'] .'&nbsp;'.$result['lastname'];?></td>
                        <td><?php echo $result['email'];?></td>
                        <td><?php echo $fm->textShorten($result['body'], 100);?></td>
                        <td><?php echo $fm->dateFormat($result['date']);?></td>
                        <td> <a onclick="return confirm('Are you sure to Delete the msg !');" href="?delid=<?php echo $result['id']; ?>">Delete</a> </td>
                    </tr>   
                    <?php } } ?>
                </tbody>
            </table>
       </div>
    </div>
</div>
<?php include 'inc/footer.php';?>