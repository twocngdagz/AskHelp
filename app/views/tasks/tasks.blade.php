@extends('layouts.master')


@section('content')

<div class="row">
	<h3 style="float:left; margin-left: 230px">View all tasks</h3>
	<div class="span9 offset2" style="text-align: center">
		<table class="dynamicTable table table-striped table-bordered table-condensed">
			<thead>
			    <tr>
			        <th>Task Name</th>
			        <th>Due Date</th>
			        <th>Completed</th>
			    </tr>
			</thead>
			<tbody>
				@foreach($tasks as $task)
				<tr>
					<td>{{link_to("tasks/$task->id", $task->title)}}</td>
					<td>{{date("m/d/Y", strtotime($task->due_date))}}</td>
					<td>
						@if($task->completed == '1')
							<input type="checkbox" checked id={{$task->id}}>
						@else
							<input type="checkbox" id={{$task->id}}>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<br>
{{link_to('/', 'Home')}}
{{ HTML::link('logout', 'Logout') }}
@stop