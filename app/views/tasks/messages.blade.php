@extends('layouts.master')


@section('content')

<div class="row">
	<h3 style="float:left; margin-left: 230px">Messages</h3>
	<div class="span9 offset2" style="text-align: center">
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