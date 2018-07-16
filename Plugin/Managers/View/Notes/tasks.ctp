<?php 
	foreach ($notes as $key => $n) {
?>
<div class="note-row">
	<?php
		echo $n['Note']['body'];
	?>
	<br><small><i class="fa fa-user"></i> <?php echo $n['User']['name']; ?> | <i class="fa fa-clock-o"></i> <?php echo $n['Note']['created']; ?></small>
</div>
<?php
	}
?>