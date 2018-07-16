<div class="row">
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<?php 
			echo $this->Form->create('Task', $options = array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'label' => false,
					'div' => array(
						'class' => 'form-group'
					)
				),
				'url' => array(
					'plugin' => 'managers',
					'controller' => 'tasks',
					'action' => 'month'
				),
				'type' => 'GET',
			));
		?>
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<?php 
					echo $this->Form->input('thang', $options = array(
						'value' => $month,
						'class' => 'form-control month input-sm'
					));
				?>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="form-group">
					<?php 
						echo $this->Form->button('<i class="fa fa-search"></i> Filter', $options = array(
							'class' => 'btn btn-default btn-sm'
						));
					?>
				</div>
			</div>
		</div>
		<?php
			echo $this->Form->end($options = null);
		?>
	</div>
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 text-center month-title">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="form-group">
					<span class="btn btn-default btn-sm" id="all"><i class="fa fa-adn"></i> All</span>
					<span class="btn btn-success btn-sm" id="done"><i class="fa fa-check-square-o"></i> Done</span> 
					<span class="btn btn-warning btn-sm" id="doing"><i class="fa fa-angle-double-right"></i> Doing</span> 
					<span class="btn btn-danger btn-sm" id="error"><i class="fa fa-exclamation-triangle"></i> Error</span>
				</div>
			</div>
			<?php 
				echo $this->Form->create('Task', $options = array(
					'inputDefaults' => array(
						'class' => 'form-control input-sm',
						'label' => false,
						'div' => array(
							'class' => 'form-group'
						)
					)
				));
			?>
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
				<?php 
					echo $this->Form->input('project_id', $options = array(
						'empty' => 'Select project',
						'class' => 'form-control project-list input-sm'
					));
				?>	
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<?php 
					echo $this->Form->input('role_id', $options = array(
						'empty' => 'Select group',
						'class' => 'form-control group-list input-sm'
					));
				?>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<?php 
					foreach ($users as $key => $u) {
						$user[$u['User']['id']] = $u['User']['name'];
					}
					echo $this->Form->input('user_id', $options = array(
						'empty' => 'Select user',
						'class' => 'form-control select-user input-sm',
						'label' => false,
						'options' => $user,
						'div' => array(
							'class' => 'form-group'
						)
					));
				?>
			</div>
			<?php 
				echo $this->Form->end($options = null);
			?>
		</div>
	</div>
</div>
<div class="table-responsive scroll-table-month">
	<?php
		$thang = explode('-', $month);
		$month = $thang[1];
		$year = $thang[0];
		$start_date = "01-".$month."-".$year;
		$start_time = strtotime($start_date);
		$end_time = strtotime("+1 month", $start_time);
	?>
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
				<td style="color: #fff; background: <?php echo $u['Role']['color']; ?>"><?php echo $u['User']['name']; ?></td>
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
				<td style="color: <?php echo $color; ?>; background: <?php echo $bgcolor; ?>">
					<div class="task-name">
					<?php 
						foreach ($u['Task'] as $key => $t) {
							$start = strtotime($t['start']);
							$end = strtotime($t['end']);
							if($end >= strtotime($start_day) && $start <= strtotime($end_date)){
								if ($t['status'] == 0) { 
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
</div>
<div class="loading-tasks"></div>
<script type="text/javascript">
	$('.loading-tasks').fadeIn('slow');
	setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
</script>