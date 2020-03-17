<?php
	include_once('db.php');
	$sql = 'select * from img';
	$query = $db->query($sql);
	?>
    <form method="post" action="effectProcess.php">
    <?php
	while($res = $query->fetch(PDO::FETCH_ASSOC)){ ?>
		<button class="ui-button" type="submit" name="effect" value="<?php echo $res['i_id'];?>"><?php echo $res['i_effect'];?></button>
        
        
	<?php }
	
?>
</form>