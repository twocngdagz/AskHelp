@extends('layouts.master')


@section('content')   
      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <!-- <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li> -->
        </ul>
        <h3 class="muted">AskHelp</h3>
      </div>

      <div class="jumbotron">
        <h1>Ask fast and comprehensive Help</h1>
        <p class="lead">Get help with faster, easier and wider scope.This SMS-Based emergency application uses simple SMS technology to send messages to emergency response agencies and NGO's/LGU's through their facebook accounts.</p>
        <a class="btn btn-large btn-success" href="#">Send Message</a>
        <button id="fb-login" class="btn btn-large btn-success">Login to Facebook</button>
      </div>
      <div class="footer">
        <p>&copy; AskHelp 2013</p>
      </div>

@stop