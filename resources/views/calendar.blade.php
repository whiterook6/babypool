@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Calendar')

@section('content')
			<div class="container">
				<h1>
					Baby Pool
					<small>for John and Caitlin</small>			
@isset($user)
					<div class="left">
						<small>Logged in as </small>
						{{$user['initials']}}
					</div>
@endisset
					<div class="right">
						<small>Total Prize Pool:</small>
						$50
					</div>
				</h1>

				<div class="calendar">
					<div class="row header">
						<div class="cell"></div>
						<div class="cell">Sunday</div>
						<div class="cell">Monday</div>
						<div class="cell">Tuesday</div>
						<div class="cell">Wednesday</div>
						<div class="cell">Thursday</div>
						<div class="cell">Friday</div>
						<div class="cell">Saturday</div>
					</div>
@foreach ($calendar as $week)
					<div class="row">
						<div class="cell month">
	@isset ($week['label'])
		{{ $week['label'] }}
	@endisset
						</div>
	@foreach ($week['days'] as $day)
		@if ($day['is_due_date'])
						<a href="/calendar/{{$day['date']}}" class="cell available highlight">
		@else
						<a href="/calendar/{{$day['date']}}" class="cell available">
		@endif
							<span class="day">{{$day['day_of_month']}}</span>
		@isset ($bids[$day['date']])
<?php
	$bid = $bids[$day['date']];
?>
							<span class="value">{{$bid['value']}}</span>
		@endisset
						</a>
	@endforeach
					</div>
@endforeach
				</div>
				<div class="row">
					<div class="col-12 form">
						<a class="button inline"
							href="/rules">Rules</a>
					</div>
				</div>
			</div>
@endsection
