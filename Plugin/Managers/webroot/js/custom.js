$(document).ready(function () {
    // Scroll to top
     $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    $('#back-to-top').tooltip('show');
    // Date time picker bootstrap
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
    $('.month').datetimepicker({  
        format: 'YYYY-MM',
        widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
        },
    });
    // Tooltip
    //$('[data-tooltip="tooltip"]').tooltip({html: true}); 
    $('body').tooltip({
        selector: '[data-tooltip=tooltip]',
        html : true
    });
    $('body').on('click','.edit_task',function () {
        var dataid = $(this).attr('data-id');
        var url = '/calendar/managers/tasks/edit';
        //alert(dataid);
        $.ajax({
            url: url, 
            method: "GET",
            data: { dataid : dataid},
            dataType: "html",
            success: function(result){
                $("#load_edit_task_form").html(result);
            }
        });
    });
    // Add error to task
    $('body').on('click','.add_error',function () {
        var dataid = $(this).attr('data-task');
        var url = '/calendar/managers/errors/add';
        //alert(dataid);
        $.ajax({
            url: url, 
            method: "GET",
            data: { dataid : dataid},
            dataType: "html",
            success: function(result){
                $("#load_add_error_form").html(result);
            }
        });
    });
    // View errors of task
    $('body').on('click', '.view_errors', function () {
        var taskid = $(this).attr('data-taskid');
        var url = '/calendar/managers/errors/tasks';
        $.ajax({
            url: url, 
            method: "GET",
            data: { taskid : taskid},
            dataType: "html",
            success: function(result){
                $("#load_errors_list").html(result);
            }
        });
    });
    // Add note for task
    $('body').on('click', '.add_note', function () {
        var taskid = $(this).attr('data-taskid');
        var url = '/calendar/managers/notes/add';
        $.ajax({
            url: url, 
            method: "GET",
            data: { taskid : taskid},
            dataType: "html",
            success: function(result){
                $(".add-note").html(result);
            }
        });
    });
    // View notes of task
    $('body').on('click', '.view_notes', function () {
        var taskid = $(this).attr('data-task');
        //alert(taskid);
        var url = '/calendar/managers/notes/tasks/';
        $.ajax({
            url: url, 
            method: "GET",
            data: { taskid : taskid},
            dataType: "html",
            success: function(result){
                $("#load_view_notes").html(result);
            }
        });
    });
    // Filter tasks by role, user, project and status
    $('body').on('change', '#filter-tasks', function () {
        $('.loading-tasks').fadeIn('slow');
        var project_id = $('.select_project').val();
        var role_id = $('#role_id').val();
        var user_id = $('.select_user').val();
        var status = $('.select_status').val();
        var page = $('#tasks-pagination li').attr('data-page');
        //alert(role_id);
        $.ajax({
            url: "/calendar/managers/tasks/ajax/", 
            method: "GET",
            data: { project_id : project_id, role_id : role_id, user_id : user_id, status : status, page : page},
            dataType: "html",
            success: function(result){
                $(".load").html(result);
                $('#tasks-pagination li').attr('data-project', project_id);
                $('#tasks-pagination li').attr('data-group', role_id);
                $('#tasks-pagination li').attr('data-user', user_id);
                $('#tasks-pagination li').attr('data-status', status);
            }
        });
        setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
    });
    var window_height = $(window).outerHeight() - 190;
    $('.scroll-table').css({'max-height': window_height, 'min-height': window_height});
    $('.scroll-table-month').css({'max-height': window_height + 60, 'min-height': window_height + 60});
    //popover
    $(function () {
        //$('[data-toggle="popover"]').popover({ html : true, placement: 'bottom', trigger: 'hover' });
        $('body').popover({
            selector: '[data-toggle=popover]',
            placement: 'bottom',
            trigger: 'hover',
            html: true
        });
    });
    // Add task
    $('body').on('click', '.add-task-td', function () {
        var start = $(this).attr('data-date');
        var user_id = $(this).attr('data-user');
        var user_name = $(this).attr('data-user-name');
        $('.start_time').val(start+' 08:00:00');
        $('.end_time').val(start+' 17:30:00');
        $(".user_id option[value='"+user_id+"']").attr("selected","selected");
        $('.user-name-task').text(user_name);
    });
    // Filter by status
    $('.month-title span').click(function () {
        $('.user-name span').fadeOut();
        $('.loading-tasks').fadeIn('slow');
        var id = $(this).attr('id');
        if(id != 'all'){
            $('.task-row').fadeOut(500);
            $('.task-row-'+id).fadeIn(500);
            var count = $('.task-row-'+id).length;
            $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>'+count+' Tasks</strong></div>');
        }else{
            $('.task-row').fadeIn(500);
            var count = $('.task-row').length;
            $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>'+count+' Tasks</strong></div>');
        }
        setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
        setTimeout(function(){$('.alert_add_task').fadeOut();},2000);
    });
    // Filter task by role
    $('.group-list').change(function () {
        $('.user-name span').fadeOut();
        $('.loading-tasks').fadeIn('slow');
        $('.select-user').addClass('rolling');
        var group_id = $(this).val();
        var url = './users/users/ajax/';
        if (group_id != '') {
            $('.user-name').fadeOut(500);
            $('.group-'+group_id).fadeIn(500);
            var count = $('.group-'+group_id+' .task-row').length;
            $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>'+count+' Tasks</strong></div>');
        }else{
            $('.user-name').fadeIn(500);
            var count = $('.user-name .task-row').length;
            $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>'+count+' Tasks</strong></div>');
        };
        $.ajax({
            method:'GET',
            url:url,
            data:{group_id:group_id},
            success:function(data){
                $('.select-user').html(data);
                setTimeout(function(){$('.select-user').removeClass('rolling');},800);
                setTimeout(function(){$('.alert_add_task').fadeOut();},2000);
            }
        });
        setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
    });
    // Filter by user
    $('.select-user').change(function () {
        $('.user-name span').fadeOut();
        $('.loading-tasks').fadeIn('slow');
        var user_id = $(this).val();
        if(user_id != ''){
            $('.user-name').fadeOut(500);
            $('.user-'+user_id).fadeIn(500);
            $('.task-name').css({'max-height':'unset'});
            var count = $('.user-'+user_id+' .task-row').length;
            $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>'+count+' Tasks</strong></div>');
        }else{
            $('.user-name').fadeIn(500);
            $('.task-name').css({'max-height':'50px'});
            var count = $('.user-name .task-row').length;
            $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>'+count+' Tasks</strong></div>');
        }
        setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
        setTimeout(function(){$('.alert_add_task').fadeOut();},2000);
    });
    // Filter task by project
    $('.project-list').change(function () {
        $('.user-name span').fadeOut();
        $('.loading-tasks').fadeIn('slow');
        var projectid = $(this).val();
        if (projectid != '') {
            $('.task-row').fadeOut(500);
            $('.project-'+projectid).fadeIn(500);
            var count = $('.project-'+projectid).length;
            $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>'+count+' Tasks</strong></div>');
        }else{
            $('.task-row').fadeIn(500);
            var count = $('.task-row').length;
            $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>'+count+' Tasks</strong></div>');
        }
        setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
        setTimeout(function(){$('.alert_add_task').fadeOut();},2000);
    });
});
// Change task
$('body').on('change','.confirm',function (ev){
    var myform = $(this).closest(".edit_form");
    var url = myform.attr('action');
    var trid = $(this).closest("tr").attr('class');
    $(this).addClass('reload');
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: myform.serialize(),
        cache: false,
        success: function (data) {
            $('tr.'+trid+'').load('# tr.'+trid+' td');
            $('.load_stat_month').load('# .load_stat_month tr');
            $('.scroll-table').load('# .scroll-table table');
            $("#calendar").fullCalendar("refetchEvents");
        },
        error: function(data){
	        $('tr#'+trid+'').load('# tr#'+trid+' td');
	    }
    });
    ev.preventDefault();
});
// Change doing task
$('body').on('click','.popup-task button',function (ev){
    $('.loading-tasks').fadeIn('slow');
    var url = '/calendar/managers/tasks/change_status/'+$(this).attr('taskid');
    var myform = $(this).closest("#TaskChangeStatusForm");
    var trid = $(this).closest("tr").attr('id');
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: myform.serialize(),
        cache: false,
        success: function (data) {
            //$('.load_doing_task').load('# .load_doing_task tr');
            $('tr#'+trid+'').load('# tr#'+trid+' td');
            $('.load_stat_month').load('# .load_stat_month tr');
            $('.scroll-table').load('# .scroll-table table');
            $("#calendar").fullCalendar("refetchEvents");
        },
        error: function(data){
            $('tr#'+trid+'').load('# tr#'+trid+' td');
        }
    });
    ev.preventDefault();
    setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
});
$('body').on('change', '.filter-doing-tasks #project_id', function () {
    $('.loading-tasks').fadeIn('slow');
    var projectid = $(this).val();
    //alert(projectid); 
    if(projectid != ''){
        $('.load_doing_task tr').fadeOut();
        $('.project-'+projectid).fadeIn();
    }else{
        $('.load_doing_task tr').fadeIn();
    }
    setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
});
$('body').on('change', '.filter-doing-tasks #role_id', function () {
    var role_id = $(this).val();
    if(role_id != ''){
        $('.load_doing_task tr').fadeOut();
        $('.role-'+role_id).fadeIn();
    }else{
        $('.load_doing_task tr').fadeIn();
    }
});
$('body').on('change', '.filter-doing-tasks #user_id', function () {
    var user_id = $(this).val();
    if(role_id != ''){
        $('.load_doing_task tr').fadeOut();
        $('.user-'+user_id).fadeIn();
    }else{
        $('.load_doing_task tr').fadeIn();
    }
});
// Xác nhận nộp tiền
$('body').on('change','.add_money',function (ev){
    var url = '/calendar/managers/funds/add';
    var add_form = $(this).closest(".funds_form");
    $(this).addClass('reload');
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: add_form.serialize(),
        cache: false,
        success: function (data) {
            $('.tab-content').load('# .tab-pane');
        },
        error: function(data){
            $('.tab-content').load('# .tab-pane');
        }
    });
    ev.preventDefault();
});
// Chỉnh sửa nộp tiền
$('body').on('change','.edit_fund',function (ev){
    var url = '/calendar/managers/funds/edit/'+$(this).attr('fundid');
    var myform = $(this).closest(".edit_fund");
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: myform.serialize(),
        cache: false,
        success: function (data) {
            $('.tab-content').load('# .tab-pane');
        },
        error: function(data){
            $('.tab-content').load('# .tab-pane');
        }
    });
    ev.preventDefault();
});
// Xem thông tin chi tiêu
$('.view-order').click(function () {
    var month_id = $(this).attr('month_id');
    //alert(month_id);
    var url = "/calendar/managers/orders/view/";
    $.ajax({
        url: url, 
        method: "GET",
        data: { month_id : month_id},
        dataType: "html",
        success: function(result){
            $(".load_view_order").html(result);
        }
    });
});
// Add my skill
$('body').on('change','.add-skill',function (ev){
    var url = '/calendar/managers/myskills/add';
    var add_form = $(this).closest(".add_skill");
    $(this).addClass('reload');
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: add_form.serialize(),
        cache: false,
        success: function (data) {
            $('.load').load('# .load tr');
        },
        error: function(data){
            $('.load').load('# .load tr');
        }
    });
    ev.preventDefault();
});
// Edit my skill
$('body').on('change','.change_status',function (ev){
    var url = '/calendar/managers/myskills/edit/'+$(this).attr('skillid');
    var myform = $(this).closest(".update_skill");
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: myform.serialize(),
        cache: false,
        success: function (data) {
            $('.load').load('# .load tr');
        },
        error: function(data){
            $('.load').load('# .load tr');
        }
    });
    ev.preventDefault();
});
// Popup doing tasks
var max_height = $(window).outerHeight() - 60;
$('.popup-task').css({'max-height': max_height});
$('.close-popup').click(function () {
    $('.popup-task .panel').toggleClass('hidden');
    var icon = $(this).find('i').attr('class');
    if(icon == 'glyphicon glyphicon-plus'){
        $(this).find('i')[0].setAttribute('class', 'glyphicon glyphicon-remove');
        $(this).css({'right': '5px'});
        $('.relative').css({'padding-bottom': '5px'});
        $('.popup-task').css({'left': '15px', 'min-height': max_height});
    }else{
        $(this).find('i')[0].setAttribute('class', 'glyphicon glyphicon-plus');
        $(this).css({'right': '12px'});
        $('.popup-task').css({'left': 'unset', 'min-height': 'unset'});
    }
});
// Using vacation day
$('#EventType').change(function () {
    var type = $(this).val();
    //alert(type);
    if (type == 1) {
        $('.vacation').css({'display':'block'});
    }else{
        $('.vacation').css({'display':'none'});
    }
});
// Delete task
$('body').on('submit', '.delete-task', function (dt) {
    //alert('Do you want delete this tasks?');
    $('.loading-tasks').fadeIn('slow');
    var taskid = $(this).attr('taskid');
    var url = '/calendar/managers/tasks/delete/'+taskid;
    var myform = $(this).closest(".delete-task");
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: myform.serialize(),
        cache: false,
        success: function (data) {
            $('.load').load('# .load tr');
            $('body').append( '<div class="alert alert-success fade in alert-dismissable alert_add_task"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Delete task success!</strong></div>');
            setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
            setTimeout(function(){$('.alert_add_task').fadeOut();},2000);
        },
        error: function(data){
            $('.load').load('# .load tr');
        }
    });
    dt.preventDefault();
});
// Confirm event ajax
$('body').on('change', '.confirm-input', function (ev) {
    $('.loading-tasks').fadeIn('slow');
    var url = '/calendar/managers/events/confirm/'+$(this).attr('eventid');
    var myform = $(this).closest(".confirm-events");
    var trid = $(this).closest("tr").attr('id');
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: myform.serialize(),
        cache: false,
        success: function (data) {
            //$('.load_pagination').load('# .load_pagination tr');
            $('tr#'+trid+'').load('# tr#'+trid+' td');
            $('#waiting').load('# #waiting .modal-dialog');
            $('#deny').load('# #deny .modal-dialog');
            $("#calendar").fullCalendar("refetchEvents");
            setTimeout(function(){$('.loading-tasks').fadeOut();},1000);
        },
        error: function(data){
            //$('.load_pagination').load('# .load_pagination tr');
            $('tr#'+trid+'').load('# tr#'+trid+' td');
        }
    });
    ev.preventDefault();
});
// Filter events by ajax
$('body').on('change', '.filter-events-ajax', function (ev) {
    $('.alert_add_task').css({display: 'none'});
    var group = $(this).find('#role_id').val();
    var user_id = $(this).find('#user_id').val();
    var type = $(this).find('#type').val();
    var status = $(this).find('#status').val();
    var page = $(this).attr('data-page');
    var url = '/calendar/managers/events/filter';
    $.ajax({
        url : url,
        type : 'GET',
        dataType : 'html',
        data : {group: group, user_id : user_id, type : type, status : status, page : page},
        success: function (data) {
            $('.load_pagination').html(data);
            $('#pagination-events a').attr('data-group', group);
            $('#pagination-events a').attr('data-user', user_id);
            $('#pagination-events a').attr('data-type', type);
            $('#pagination-events a').attr('data-status', status);
        }
    });
    ev.preventDefault();
});
// Pagination event
$('body').on('click', '#pagination-events a', function () {
    var classs = $(this).attr('class');
    var page = $(this).attr('data-page');
    var max = $('.normal').length;
    var group = $(this).attr('data-group');
    var user_id = $(this).attr('data-user');
    var type = $(this).attr('data-type');
    var status = $(this).attr('data-status');
    $('.loading-tasks').fadeIn('slow');
    $('#pagination-events li').removeClass('active');
    $(this).parent().addClass('active');
    $('.prev, .next').parent('li').removeClass('active');
    if (page > 1) {
        var prev = page - 1;
        $('a.prev').removeClass('hidden');
        $('a.prev').attr('data-page', prev);
    } else {
        $('a.prev').addClass('hidden');
    }

    if (page == max) {
        $('a.next').addClass('hidden');
    } else {
        var next = parseInt(page) + 1;
        $('a.next').removeClass('hidden');
        $('a.next').attr('data-page', next);
    }

    if(classs == 'prev' || classs == 'next'){
        $('#pagination-events a').removeClass('active');
        $('#pagination-events').find('[data-page="'+page+'"]').addClass('active');
    } else {
        $('#pagination-events a').removeClass('active');
    }
    var url = '/calendar/managers/events/paginaion';
    $.ajax({
        method: 'GET',
        url: url,
        data: { page : page, group : group, user_id : user_id, type : type, status : status},
        dataType: 'html',
        success: function (data) {
            $('.load_pagination').html(data);
            $('#pagination-events a').attr('data-group', group);
            $('#pagination-events a').attr('data-user', user_id);
            $('#pagination-events a').attr('data-type', type);
            $('#pagination-events a').attr('data-status', status);
        }
    });
    setTimeout(function(){$('.loading-tasks').fadeOut();},700);
});