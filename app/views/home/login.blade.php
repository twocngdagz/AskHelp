@extends('layouts.master')

@section('content')
@if (Session::has('login_errors'))
    <span class="error">Username or password incorrect.</span>
@endif
<div class="row">
	<div class="span4 offset4" style="text-align: center">
		{{ Form::open(array('url'=>'/auth','class'=>'form')) }}
			<fieldset>
				<legend>Login</legend>
				{{ Form::label('username', 'Username:') }}
				{{ Form::text('username',null,array('class'=>'form-control', 'required'=>'required', 'placeholder'=>'')) }}
				{{ Form::label('password', 'Password:') }}
				{{ Form::password('password',null,array('class'=>'form-control', 'required'=>'required', 'placeholder'=>'Password here')) }}
				<div class="form-group">
					{{ Form::submit('Login', array('class'=>'btn btn-success','id'=>'newtask')) }}
				<div>
			</fieldset>
		{{ Form::close() }}
	</div>
</div>
@endsection