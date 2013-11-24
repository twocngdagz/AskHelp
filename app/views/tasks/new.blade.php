@extends('layouts.master')

@section('content')
<div class="row">
	<div class="span6 offset3" style="text-align: center">
		{{ Form::open(array('url'=>'tasks/create','class'=>'form')) }}
			<fieldset>
				<legend>Add a New Task</legend>
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title',null,array('class'=>'form-control', 'required'=>'required', 'placeholder'=>'Title of the task here..')) }}
				{{ Form::label('due_date', 'Date Due:') }}
				{{ Form::text('due_date',null,array('class'=>'form-control', 'required'=>'required', 'placeholder'=>'Task Due Date')) }}
				<div class="form-group">
					{{ Form::submit('Create Task', array('class'=>'btn btn-primary','id'=>'newtask')) }}
				<div>
			</fieldset>
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