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
							<th></th>
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
@foreach($bids as $week)
						<tr>
							<td>April</td>
	@foreach($week as $day)
							<td class="date available">
		@foreach($day as $bid)
								<div class="bid">
			@if ($bid['confirmed'])
									<span class="fa fa-check"></span>
			@else
									<span class="fa fa-clock-o"></span>
			@endif
									<span class="email">{{$bid['email']}}</span>
									<span class="value">{{$bid['amount']}}</span>
									<span class="date">{{$bid['date']}}</span>
								</div>
		@endforeach
							</td>
	@endforeach
						</tr>
@endforeach
					</tbody>
				</table>
			</div>
@endsection