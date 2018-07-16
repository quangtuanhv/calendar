<?php 
	foreach ($projects as $key => $project) { 
?>
<tr>
	<td><?php echo $key+1; ?></td>
	<td>
		<?php 
			echo $this->Html->link($project['Project']['title'], array('controller' => 'projects', 'action' => 'view', 'id' => $project['Project']['id'], 'slug' => Inflector::slug($project['Project']['title'], $replacement = '-')));
		?>
	</td>
	<td>
		<?php echo $project['User']['name']; ?>
	</td>
	<td>
		<?php echo $project['Project']['start']; ?>
	</td>
	<td>
		<?php echo $project['Project']['end']; ?>
	</td>
	<td>
		<?php echo count($projects[$key]['Task']); ?>
	</td>
</tr>
<?php }  ?>