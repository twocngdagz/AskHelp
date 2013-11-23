@extends('layouts.master')


@section('content')

<div class="row">	
	<div class="span6 offset1" style="text-align: center">
		<h3>Messages</h3>
		<table class="dynamicTable table table-striped table-bordered table-condensed">
			<thead>
			    <tr>
			        <th>Cellphone Number</th>
			        <th>Message</th>
			        <th>RRN</th>
			    </tr>
			</thead>
			<tbody>
				@foreach($messages as $message)
				<tr>
					<td>{{$message->msisdn}}</td>
					<td>{{$message->text}}</td>
					<td>{{$message->rrn}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop