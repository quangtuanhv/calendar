<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title"><b><?php echo __d('croogo', 'Statistical on ').$month; ?></b></h3>
	</div>
	<div class="panel-body">
		<?php 
			$events = json_decode($json);
			if (!empty($events)) {
		?>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th><?php echo __d('croogo', 'Title'); ?></th>
					<th><?php echo __d('croogo', 'User'); ?></th>
					<th><?php echo __d('croogo', 'Type'); ?></th>
					<th><?php echo __d('croogo', 'Start'); ?></th>
					<th><?php echo __d('croogo', 'End'); ?></th>
					<th><?php echo __d('croogo', 'Status'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($events as $key => $event) { ?>
				<tr>
					<td><?php echo $key+1; ?></td>
					<td>
						<a href="#" data-tooltip="tooltip" title="<?php echo $event->body; ?>"><?php echo $event->title; ?></a>
					</td>
					<td><?php echo $event->user; ?></td>
					<td>
						<?php 
							if ($event->type == 1) {
								echo __d('croogo', 'Full day');
							}elseif ($event->type == 2) {
								echo __d('croogo', 'Hafl day');
							}
							elseif ($event->type == 3) {
								echo __d('croogo', 'Later');
							}else{
								echo __d('croogo', 'Early');
							}
						?>
					</td>
					<td><?php echo $event->start; ?></td>
					<td><?php echo $event->end; ?></td>
					<td>
						<?php 
							if ($event->status == 0) {
								echo '<span class="btn btn-warning btn-sm">'.__d('croogo', 'Waiting confirm').'</span>';
							}elseif ($event->status == 1) {
								echo '<span class="btn btn-success btn-sm">'.__d('croogo', 'Confirmed').'</span>';
							}else{
								echo '<span class="btn btn-danger btn-sm">'.__d('croogo', 'Deny').'</span>';
							}
						?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php }else{ echo __d('croogo', 'Not found'); } ?>
	</div>
</div>