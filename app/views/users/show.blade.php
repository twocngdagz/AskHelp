@extends('layouts.master')

@section('content')
<div class="row">
	<div class="span6 offset1" style="text-align: center">
		{{ Form::open(array('url'=>'users/edit','class'=>'form')) }}
			<fieldset>
				<legend>Update or Delete a User</legend>
				{{ Form::hidden('id',$user->id)}}
				{{ Form::label('cellnumber', 'Cellnumber:') }}
				{{ Form::text('cellnumber',$user->cellnumber,array('class'=>'form-control', 'required'=>'required', 'placeholder'=>'Cellnumber')) }}
				<div class="form-group">
					{{ Form::submit('Update User', array('class'=>'btn btn-primary','id'=>'updatetask')) }}
					<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">Delete User</a>
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
    {{ Form::open(array('url'=>'users/delete','class'=>'form')) }}
      {{ Form::hidden('id',$user->id)}}
      <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">No</button>
      {{ Form::submit('Yes', array('class'=>'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection