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
@for($week = $bounds['max_date']['week']; $week <= $bounds['max_date']['week']; $week++)
						<tr>
							<td>April</td>
	@for($dow = 0; $dow < 7; $dow++)
							<td class="date available">
		@if (!empty($bids[$week][$dow]))
			@foreach ($bids[$week][$dow] as $bid)
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
		@endif
							</td>
	@endfor
						</tr>
@endfor
					</tbody>
				</table>
			</div>
@endsection