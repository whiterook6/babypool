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

				<table class="calendar">
					<thead>
						<tr>
							<th>
							<th>Sunday</th>
							<th>Monday</th>
							<th>Tuesday</th>
							<th>Wednesday</th>
							<th>Thursday</th>
							<th>Friday</th>
							<th>Saturday</th>
						</tr>
					</thead>
					<tbody>
@foreach ($calendar as $week)
						<tr>
							<td class="month">
	@isset ($week['label'])
		{{ $week['label'] }}
	@endisset
							</td>
	@foreach ($week['days'] as $day)
							<td class="available">{{$day}}</td>
	@endforeach
						</tr>
@endforeach
					</tbody>
				</table>
			</div>
@endsection