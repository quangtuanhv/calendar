<?php 
	echo $this->Form->create('Note', $options = array(
		'inputDefaults' => array(
			'class' => 'form-control',
			'label' => false,
			'div' => array(
				'class' => 'form-group'
			)
		)
	));
	echo $this->Form->input('body', $options = array(
		'placeholder' => 'Note detail',
		'required' => true
	));
	echo $this->Form->button('<i class="fa fa-floppy-o"></i> Save', $options = array(
		'class' => 'btn btn-info save_note'
	));
	echo $this->Form->end($options = null);
?>
<script type="text/javascript">
    var frm = $('#NoteAddForm');
    var submit = $('.save_note');  // submit button
    frm.submit(function (ev) {
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            dataType: 'html',
            data: frm.serialize(),
            beforeSend: function() {
                submit.html('Saving....'); // change submit button text
            },
            success: function (data) {
                frm.trigger('reset'); // reset form
                submit.html('Send Email'); // reset submit button text
                $('.load').load('# .load tr');
                $('#add-note').modal('hide');
            },
            error: function(data){
		        $('.load').load('# .load tr');
		        $('#add-note').modal('hide');
		    }
        });
        ev.preventDefault();
    });
</script>