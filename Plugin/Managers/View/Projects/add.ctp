<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title"><b><?php echo $title_for_layout; ?></b></h3>
	</div>
	<div class="panel-body">
		<?php 
			echo $this->Form->create('Project', $options = array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div' => array('class' => 'form-group'),
					'label' => false
				)
			));
			echo $this->Form->input('title', $options = array(
				'placeholder' => __d('croogo', 'Project name'),
				'required' => true
			));
			echo $this->Form->input('body', $options = array(
				'placeholder' => __d('croogo', 'Project info'),
				'required' => true
			));
		?>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<?php 
					echo $this->Form->input('start', $options = array(
						'label' => __d('croogo', 'Start time'),
						'type' => 'text',
						'required' => true,
						'class' => 'form-control date',
						'value' => date("Y-m-d")
					));
				?>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<?php 
					echo $this->Form->input('end', $options = array(
						'label' => __d('croogo', 'End time'),
						'type' => 'text',
						'required' => true,
						'class' => 'form-control date',
						'value' => date("Y-m-d")
					));
				?>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<?php 
					echo $this->Form->input('user_id', $options = array(
						'empty' => __d('croogo', 'Project manager'),
						'required' => true,
					));
				?>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<?php 
					echo $this->Form->input('demo', $options = array(
						'placeholder' => __d('croogo', 'URL test'),
					));
				?>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
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