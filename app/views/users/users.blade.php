@extends('layouts.master')


@section('content')

<div class="row">	
	<div class="span6 offset1" style="text-align: center">
		<h3>Users</h3>
		<table class="dynamicTable table table-striped table-bordered table-condensed">
			<thead>
			    <tr>
			        <th>First Name</th>
			        <th>Last Name</th>
			        <th>Username</th>
			        <th>Cellnumber</th>
			    </tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{link_to("users/$user->id",$user->firstname)}}</td>
					<td>{{$user->lastname}}</td>
					<td>{{$user->username}}</td>
					<td>{{$user->cellnumber}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop