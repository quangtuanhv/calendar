<?php if(!empty($projects)){ ?>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th class="text-center">#</th>
			<th>Project name</th>
			<th>PM</th>
			<th>Start</th>
			<th>End</th>
			<th class="text-center">Tasks</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($projects as $key => $p) { ?>
		<tr>
			<td class="text-center"><?php echo $key+1; ?></td>
			<td>
				<?php 
					echo $this->Html->link($p['Project']['title'], array('controller' => 'projects', 'action' => 'view', 'id' => $p['Project']['id'], 'slug' => Inflector::slug($p['Project']['title'], $replacement = '-')));
				?>
			</td>
			<td><?php echo $p['Project']['User']['name']; ?></td>
			<td><?php echo $p['Project']['start']; ?></td>
			<td><?php echo $p['Project']['end']; ?></td>
			<td class="text-center"><?php echo $p['Project']['Task'][0]['Task'][0]['tasks']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<div class="text-center">
	<ul class="pagination"><?php echo $this->Paginator->numbers(); ?></ul>
</div>
<?php } else { echo "<p class='alert alert-danger'>You don't have project</p>"; } ?>