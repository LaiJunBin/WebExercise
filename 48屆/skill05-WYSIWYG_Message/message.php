<?php
	include_once('db.php');
	$sql = 'select * from msg';
	$query = $db->query($sql);
	while($result = $query->fetch(PDO::FETCH_ASSOC)){ ?>
		<button class="ui-button showMsgBtn" va="<?php echo $result['m_id'];?>"><?php echo $result['m_title'];?></button>
	<?php }
?>
<div id="msgShowDiv" style="display:none;">
	<main></main>
</div>
<script>

	$("#msgShowDiv").dialog({
		autoOpen:false,
		width:824,
		height:768
	});
	$(".showMsgBtn").click(function(){
		var id = $(this).attr('va');
		$.ajax({
			url:'query.php',
			method:'POST',
			dataType:'JSON',
			data:{
				id:id	
			},
			success:function(res){
				$("#msgShowDiv main").html(res.m_content);
				$("#msgShowDiv").dialog('option','title',res.m_title);
				$("#msgShowDiv").dialog('open');
			}
		});
		
	});
</script>