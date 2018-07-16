<?php 
	pr($projects);
?>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Project name</th>
			<th>PM</th>
			<th>Start</th>
			<th>End</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($projects as $key => $p) {
		?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td>
				<?php 
					echo $this->Html->link($p['Project']['title'], array('controller' => 'projects', 'action' => 'view', 'id' => $p['Project']['id'], 'slug' => Inflector::slug($p['Project']['title'], $replacement = '-')));
				?>
			</td>
			<td><?php echo $p['User']['name']; ?></td>
			<td><?php echo $p['Project']['start']; ?></td>
			<td><?php echo $p['Project']['end']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<div class="text-center">
	<ul class="pagination"><?php echo $this->Paginator->numbers(); ?></ul>
</div>