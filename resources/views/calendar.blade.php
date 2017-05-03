@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Title')

@section('content')
			<div class="container">
				<h1>
					Baby Pool
					<small>for John and Caitlin</small>
					<div class="right">
						<small>Total raised:</small>
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
						<a href="/calendar/{{$day['date']}}" class="cell available">
							<span class="day">{{$day['day_of_month']}}</span>
		@isset ($bids[$day['date']])
<?php
	$bid = $bids[$day['date']];
	switch ($bid['status']){
		case 'unconfirmed':
?>
							<span class="fa fa-clock-o"></span>
<?php
			break;
		case 'confirmed':
?>
							<span class="fa fa-check"></span>
<?php
			break;
		case 'paid':
?>
							<span class="fa fa-money"></span>
<?php
			break;
	}
?>
							<span class="value">{{$bid['value']}}</span>
		@endisset
						</a>
	@endforeach
					</div>
@endforeach
				</div>
			</div>
@endsection
