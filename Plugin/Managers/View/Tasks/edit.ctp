<?php 
	echo $this->Form->create('Task', $options = array(
		'inputDefaults' => array(
			'class' => 'form-control',
			'div' => array('class' => 'form-group')
		)
	));
	echo $this->Form->input('id', $options = array());
	echo $this->Form->input('title', $options = array(
		'label' => __d('croogo', 'Task name'),
		'required' => true
	));
	echo $this->Form->input('body', $options = array(
		'label' => __d('croogo', 'Task detail'),
		'required' => true
	));
	echo $this->Form->input('url', $options = array(
		'label' => __d('croogo', 'Page url')
	));
?>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<?php 
			echo $this->Form->input('start', $options = array(
				'label' => __d('croogo', 'Start time'),
				'type' => 'text',
				'class' => 'form-control datetime',
				'required' => true
			));
		?>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<?php 
			echo $this->Form->input('end', $options = array(
				'label' => __d('croogo', 'End time'),
				'type' => 'text',
				'class' => 'form-control datetime',
				'required' => true
			));
		?>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php 
			echo $this->Form->end(array(
				'class' => 'btn btn-info btn-sm update',
				'label' => __d('croogo', 'Update')
			));
		?>
	</div>
</div>
<script type="text/javascript">
	$('.datetime').datetimepicker({  
	   	format: 'YYYY-MM-DD HH:mm',
	   	widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
        },
	});
	var frm = $('#TaskEditForm');
    var submit = $('.update');  // submit button
    frm.submit(function (ev) {
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            dataType: 'html',
            data: frm.serialize(),
            beforeSend: function() {
                submit.html('Sending....'); // change submit button text
            },
            success: function (data) {
                frm.trigger('reset'); // reset form
                submit.html('Send Email'); // reset submit button text
                $('.load').load('# .load tr');
            	$('#edit-task').modal('hide');
            },
            error: function(data){
		        $('.load').load('# .load tr');
		        $('#edit-task').modal('hide');
		    }
        });
        ev.preventDefault();
    });
</script>