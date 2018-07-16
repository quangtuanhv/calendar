<?= $this->Html->script('http://maps.google.com/maps/api/js?key=AIzaSyA3Yq6qsh0X5iYHk4F0cPqEaU2vvnHWENc&sensor=true', true); ?>
<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#info" aria-controls="info" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Infomation'); ?></a>
		</li>
		<li role="presentation">
			<a href="#tasks-list" aria-controls="tasks-list" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Tasks'); ?> ( <?php echo count($tasks); ?> )</a>
		</li>
		<li role="presentation">
			<a href="#errors-list" aria-controls="errors-list" role="tab" data-toggle="tab"><?php echo __d('croogo', 'Errors'); ?>( <?php echo count($errors); ?> )</a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="info">
			<table class="table table-bordered table-hover">
				<tbody>
					<tr>
						<th><?php echo __d('croogo', 'Full name'); ?></th>
						<td><?php echo $user['User']['name']; ?></td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Email'); ?></th>
						<td><?php echo $user['User']['email']; ?></td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Phone'); ?></th>
						<td><?php echo $user['User']['phone']; ?></td>
					</tr>
					<tr>
						<th><?php echo __d('croogo', 'Birthday'); ?></th>
						<td><?php echo $user['User']['birthday']; ?></td>
					</tr>
					<tr>
						<td colspan="2">
							<?php
				      			$map_options = array(
							        "id"         => "map_canvas",
							        "width"      => "100%",
							        "height"     => "300px",
							        "zoom"       => 16,
							        "type"       => "ROOFTOP",
							        "custom"     => "mapTypeControl: false, disableDefaultUI: true",
							        "localize"   => false,
							        "address"    => $user['User']['address'],
							        "marker"     => true,
							        "markerIcon" => '/placeholder.png',
							        "infoWindow" => true,
							        "windowText" => $user['User']['address'],
							        "markerTitle" => $user['User']['address'],
						      	);
						    ?>
				   			<?= $this->GoogleMap->map($map_options); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="tasks-list">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo __d('croogo', 'Task'); ?></th>
						<th><?php echo __d('croogo', 'Project'); ?></th>
						<th><?php echo __d('croogo', 'Start'); ?></th>
						<th><?php echo __d('croogo', 'End'); ?></th>
						<th><?php echo __d('croogo', 'Errors'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($tasks as $key => $task) { ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $task['Task']['title']; ?></td>
						<td><?php echo $task['Project']['title']; ?></td>
						<td><?php echo $task['Task']['start']; ?></td>
						<td><?php echo $task['Task']['end']; ?></td>
						<td>
							<?php 
								echo count($tasks[$key]['Error']);
							?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="errors-list">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo __d('croogo', 'Error'); ?></th>
						<th><?php echo __d('croogo', 'Task'); ?></th>
						<th><?php echo __d('croogo', 'Status'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($errors as $key => $error) { ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $error['Error']['title']; ?></td>
						<td><?php echo $error['Task']['title']; ?></td>
						<td>
							<?php 
								if ($error['Error']['status'] == 0) {
									echo '<span class="btn btn-danger btn-sm">'.__d('croogo', 'Fixing').'</span>';
								}else{
									echo '<span class="btn btn-success btn-sm">'.__d('croogo', 'Done').'</span>';
								}
							?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>