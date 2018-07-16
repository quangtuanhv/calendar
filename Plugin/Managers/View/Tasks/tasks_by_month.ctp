<div class="alert alert-success fade in alert-dismissable alert_add_task">
	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong><?php echo $month.' | '.$count; ?> Tasks</strong>
</div>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<td class="name-full">Name/Date</td>
			<?php 
				for($i=$start_time; $i<$end_time; $i+=86400){ 
					$list = date('Y-m-d', $i);
					$day = date('D', $i);
					$today = date('Y-m-d');
					if($day == 'Sun'){
						$bgcolor = 'rgba(217,83,79,0.5)';
						$color = '#fff';
					}elseif ($day == 'Sat') {
						$bgcolor = 'rgba(216,151,31,0.5)';
						$color = '#fff';
					}elseif ($today == $list) {
						$bgcolor = '#eee';
						$color = '#000';
					}else{
						$bgcolor = '#fff';
						$color = '#000';
					}
			?>
			<td class="date-full" style="color: <?php echo $color; ?>; background: <?php echo $bgcolor; ?>">
				<?php echo $list; ?><br>
			</td>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($users as $key => $u) { 
		?>
		<tr class="user-name user-<?php echo $u['User']['id']; ?> group-<?php echo $u['User']['role_id']; ?>">
			<td style="color: #fff; background: <?php echo $u['Role']['color']; ?>"><?php echo $u['User']['name']; ?> <span><small><?php echo count($u['Task']); ?></small></span></td>
			<?php 
				for($i=$start_time; $i<$end_time; $i+=86400){ 
					$list = date('Y-m-d', $i);
					$day = date('D', $i);
					$today = date('Y-m-d');
					if($day == 'Sun'){
						$bgcolor = 'rgba(217,83,79,0.5)';
						$color = '#fff';
					}elseif ($day == 'Sat') {
						$bgcolor = 'rgba(216,151,31,0.5)';
						$color = '#fff';
					}elseif ($today == $list) {
						$bgcolor = '#eee';
						$color = '#000';
					}else{
						$bgcolor = '#fff';
						$color = '#000';
					}
					$start_day = $list.' 00:00:00';
					$end_date = $list.' 23:59:59';
			?>
			<td style="color: <?php echo $color; ?>; background: <?php echo $bgcolor; ?>" class="<?php echo $day; ?>">
				<div class="task-name">
					<?php if($day != 'Sun' && $day != 'Sat'){ ?>
						<?php
							if($this->Session->read('Auth.User.role_id') == 1 || $this->Session->read('Auth.User.role_id') == 7 || $this->Session->read('Auth.User.role_id') == 8 || $this->Session->read('Auth.User.id') == $u['User']['id'] || $this->Session->read('Auth.User.id') == 16 || $this->Session->read('Auth.User.id') == 12){
						?>
						<a href="#add-task" data-toggle="modal" data-user="<?php echo $u['User']['id']; ?>" data-date="<?php echo $list; ?>" data-user-name="<?php echo $u['User']['name']; ?>" class="add-task-td"><i class="fa fa-plus"></i></a>
						<?php } ?>
					<?php } ?>
					<?php 
						foreach ($u['Task'] as $key => $t) {
							$start = strtotime($t['start']);
							$end = strtotime($t['end']);
							if($end >= strtotime($start_day) && $start <= strtotime($end_date)){
								if(count($t['Error']) > 0){
									$status = 'Error';
									$bgcolor = '#d9534f';
									$class = 'error';
								} else {
									if ($t['status'] == 0 ) { 
										$status = 'Doing'; 
										$bgcolor = '#f0ad4e'; 
										$class = 'doing';
									} elseif ($t['status'] == 2) {
										$status = 'Error';
										$bgcolor = '#d9534f';
										$class = 'error';
									} else { 
										$status = 'Done'; 
										$bgcolor = '#449d44'; 
										$class = 'done';
									}
								}
								$project = $this->Html->link($t['Project']['title'], array('controller' => 'projects', 'action' => 'view', 'id' => $t['Project']['id'], 'slug' => Inflector::slug($t['Project']['title'], $replacement = '-')));
								echo '<div class="task-row task-row-'.$class.' project-'.$t['Project']['id'].'" style="background: '.$bgcolor.'"><small><a href="javascript:void(0)" data-toggle="popover" title="'.$t['title'].'" data-content="User: '.$u['User']['name'].'<br>Project: '.$t['Project']['title'].'<br>Start time: '.$t['start'].'<br>End time: '.$t['end'].'<br>Status: '.$status.'"><i class="fa fa-list-ol"></i> '.$t['title'].'</a><br><i class="fa fa-th-list"></i> '.$project.'</small></div>';
							}
						}
					?>
				</div>
			</td>
			<?php } ?>
		</tr>
		<?php } ?>
	</tbody>
</table>