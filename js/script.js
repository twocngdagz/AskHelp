$(function()
{
	$("#due_date").datepicker({format: 'mm/dd/yyyy'}).on('changeDate',function(e) {
		$('#due_date').datepicker('hide');
	});

	$("#newtask").click(function(e) {
		var task = $('#due_date').datepicker('getDate');
		var today = new Date();
		var task_day = task.getDate();
		var task_month = task.getMonth() + 1;
		var task_year = task.getFullYear();
		var today_day = today.getDate();
		var today_month = today.getMonth() + 1;
		var today_year = today.getFullYear();
		var error = false;
		if (task_year < today_year) {
			error = true;
		} else if (task_month < today_month) {
			error = true;
		} else if (task_day < today_day) {
			error = true;
		}
		if (error) {
			e.preventDefault();
			$('#errorModal').modal();
		} else {
			this.submit();
		}
	});

	$("#updatetask").click(function(e) {
		var task = $('#due_date').datepicker('getDate');
		var today = new Date();
		var task_day = task.getDate();
		var task_month = task.getMonth() + 1;
		var task_year = task.getFullYear();
		var today_day = today.getDate();
		var today_month = today.getMonth() + 1;
		var today_year = today.getFullYear();
		var error = false;
		if (task_year < today_year) {
			error = true;
		} else if (task_month < today_month) {
			error = true;
		} else if (task_day < today_day) {
			error = true;
		}
		if (error) {
			e.preventDefault();
			$('#errorModal').modal();
		} else {
			this.submit();
		}
	});

	if ($('.dynamicTable').size() > 0)
	{
		$('.dynamicTable').dataTable({
			"aaSorting": [[ 1, 'desc' ]],
			"sPaginationType": "bootstrap",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			}
		});
	}

	$('input:checkbox').on('change', function(e) {
		if($(this).is(':checked')) {
			var task_id = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: "tasks/update",
				data: {id:task_id, completed:1}
			});
		} else {
			var task_id = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: "tasks/update",
				data: {id:task_id, completed:0}
			});
		}
	});
});