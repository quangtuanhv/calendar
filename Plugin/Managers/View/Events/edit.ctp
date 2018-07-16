<div class="panel panel-warning">
	<div class="panel-heading">
		<h3 class="panel-title"><b><?php echo $title_for_layout; ?></b></h3>
	</div>
	<div class="panel-body">
		<?php 
			echo $this->Form->create('Event', $options = array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div' => array('class' => 'form-group')
				)
			));
			echo $this->Form->input('id', $options = array());
			echo $this->Form->input('title', $options = array(
				'required' => true
			));
			echo $this->Form->input('body', $options = array(
				'label' => __d('croogo', 'Reason'),
				'required' => true
			));
		?>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<?php 
					echo $this->Form->input('start', $options = array(
						'class' => 'form-control datetime',
						'type' => 'text',
						'label' => __d('croogo', 'Start time'),
						'required' => true
					));
				?>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<?php 
					echo $this->Form->input('end', $options = array(
						'class' => 'form-control datetime',
						'type' => 'text',
						'label' => __d('croogo', 'End time'),
						'required' => true
					));
				?>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php 
					echo $this->Form->button('<i class="glyphicon glyphicon-floppy-disk"></i> '.__d('croogo', 'Save'), $options = array(
						'class' => 'btn btn-info btn-sm'
					));
					echo $this->Form->end($options = null);
				?>
			</div>
		</div>
	</div>
</div>