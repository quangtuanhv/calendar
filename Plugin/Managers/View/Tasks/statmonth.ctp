<?php 
	foreach ($users as $key => $u) { 
?>
<tr>
	<td class="text-center"><?php echo $key+1; ?></td>
	<td style="color: #fff; background: <?php echo $u['Role']['color']; ?>"><?php echo $u['User']['name']; ?></td>
	<td class="text-center">
		<?php if(count($u['Task']) != 0){ ?>
		<a class="btn btn-default btn-sm view-task-user" href="#view-task-user" data-toggle="modal" data-userid="<?php echo $u['User']['id']; ?>" data-username="<?php echo $u['User']['name']; ?>" data-status="" data-month="<?php echo $thang; ?>"><?php echo count($u['Task']); ?></a>
		<?php }else{ ?>
		<span class="btn btn-default btn-sm disabled"><?php echo count($u['Task']); ?></span>
		<?php } ?>
	</td>
	<td class="text-center">
		<?php 
			$done = 0;
			$doing = 0;
			$error = 0;
			foreach ($u['Task'] as $key => $t) {
				if($t['status'] == 1){
					$done += count($t['id']);
				}elseif ($t['status'] == 0) {
					$doing += count($t['id']);
				}else{
					$error += count($t['id']);
				}
			}
			if($done != 0){
		?>
		<a class="btn btn-success btn-sm view-task-user" href="#view-task-user" data-toggle="modal" data-userid="<?php echo $u['User']['id']; ?>" data-username="<?php echo $u['User']['name']; ?>" data-status="1" data-month="<?php echo $thang; ?>"><?php echo $done; ?></a>
		<?php
			}else{
				echo '<span class="btn btn-success btn-sm disabled">'.$done.'</span>';
			}
		?>
	</td>
	<td class="text-center">
		<?php if($doing != 0){ ?>
		<a class="btn btn-warning btn-sm view-task-user" href="#view-task-user" data-toggle="modal" data-userid="<?php echo $u['User']['id']; ?>" data-username="<?php echo $u['User']['name']; ?>" data-status="0" data-month="<?php echo $thang; ?>"><?php echo $doing; ?></a>
		<?php }else{ echo '<span class="btn btn-warning btn-sm disabled">'.$doing.'</span>'; } ?>
	</td>
	<td class="text-center">
		<?php if($error != 0){ ?>
		<a class="btn btn-danger btn-sm view-task-user" href="#view-task-user" data-toggle="modal" data-userid="<?php echo $u['User']['id']; ?>" data-username="<?php echo $u['User']['name']; ?>" data-status="2" data-month="<?php echo $thang; ?>"><?php echo $error; ?></a>
		<?php }else{ echo '<span class="btn btn-danger btn-sm disabled">'.$error.'</span>'; } ?>
	</td>
</tr>
<?php } ?>