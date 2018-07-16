<?php 
	echo $this->Form->create('Error', $options = array(
		'inputDefaults' => array(
			'class' => 'form-control',
			'label' => false,
			'div' => array('class' => 'form-group')
		)
	));
	echo $this->Form->input('title', $options = array(
		'placeholder' => __d('croogo', 'Error name'),
		'required' => 'true'
	));
	echo $this->Form->input('body', $options = array(
		'placeholder' => __d('croogo', 'Error detail'),
		'required' => 'true'
	));
	echo $this->Form->end(array(
		'class' => 'btn btn-info btn-sm save',
		'label' => __d('croogo', 'Save')
	));
?>
<script type="text/javascript">
    var frm = $('#ErrorAddForm');
    var submit = $('.save');  // submit button
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
                $('#add-error').modal('hide');
            },
            error: function(data){
		        $('.load').load('# .load tr');
		        $('#add-error').modal('hide');
		    }
        });
        ev.preventDefault();
    });
</script>