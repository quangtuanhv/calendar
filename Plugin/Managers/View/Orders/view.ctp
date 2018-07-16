<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo __d('croogo', 'Reason'); ?></th>
			<th><?php echo __d('croogo', 'Date'); ?></th>
			<th><?php echo __d('croogo', 'Total'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total = 0;
			foreach ($orders as $key => $o) {
				$total += $o['Order']['total'];
		?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $o['Order']['title']; ?></td>
			<td><?php echo $o['Order']['date']; ?></td>
			<td><?php echo $o['Order']['total']; ?></td>
		</tr>
		<?php
			}
		?>
		<tr>
			<th colspan="3"><?php echo __d('croogo', 'Total'); ?></th>
			<td><?php echo $total; ?></td>
		</tr>
	</tbody>
</table>