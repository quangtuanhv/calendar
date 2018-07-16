$(document).ready(function () {
	$('.date').datetimepicker({  
	   	format: 'YYYY-MM-DD',
	   	widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
        },
	});
	$('.datetime').datetimepicker({  
	   	format: 'YYYY-MM-DD HH:mm',
	   	widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
        },
	});
    
})
// Change status task
$('body').on('change','.confirm',function (ev){
    var url = '/manager/managers/tasks/change_status/'+$(this).attr('taskid');
    var myform = $(this).closest(".confirm_form");
    console.log(url);
    $.ajax({
        type: $('.confirm_form').attr('method'),
        url: url,
        dataType: 'html',
        data: myform.serialize(),
        success: function (data) {
            $('.table').load('# .load_ajax');
            // $('.left_content')
            //     .append('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Đã xác nhận lịch nghỉ!</div>');
            // setTimeout(function () {
            //     $('.alert').fadeOut('slow');
            // }, 2000);
            alert('OK');
        }
    });
    ev.preventDefault();
});