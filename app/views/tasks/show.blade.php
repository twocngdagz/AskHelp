@extends('layouts.master')

@section('content')
<div class="row">
	<div class="span6 offset3" style="text-align: center">
		{{ Form::open(array('url'=>'tasks/update_all','class'=>'form')) }}
			<fieldset>
				<legend>Update or Delete a Task</legend>
				{{ Form::hidden('id',$task->id)}}
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title',$task->title,array('class'=>'form-control', 'required'=>'required', 'placeholder'=>'Title of the task here..')) }}
				{{ Form::label('due_date', 'Date Due:') }}
				{{ Form::text('due_date',date("m/d/Y", strtotime($task->due_date)),array('class'=>'form-control', 'required'=>'required', 'placeholder'=>'Task Due Date')) }}
				<div class="form-group">
					{{ Form::submit('Update Task', array('class'=>'btn btn-primary','id'=>'updatetask')) }}
					<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">Delete Task</a>
				<div>
			</fieldset>
		{{ Form::close() }}
	</div>
</div>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 style="text-align: left">Please confirm</h4>
  </div>
  <div class="modal-body">
    <p style="text-align: left">Are you sure you want to continue?</p>
  </div>
  <div class="modal-footer">
  	{{ Form::open(array('url'=>'tasks/delete','class'=>'form')) }}
  		{{ Form::hidden('id',$task->id)}}
    	<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">No</button>
    	{{ Form::submit('Yes', array('class'=>'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
<div id="errorModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 style="text-align: left">Validation Error</h4>
  </div>
  <div class="modal-body">
    <p style="text-align: left">Task due date is less than the current date!!!</p>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button>
  </div>
</div>  
<br>
<br>
{{link_to('/', 'Home')}}

@endsection