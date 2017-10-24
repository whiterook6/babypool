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
						<a href="/users/me">{{$user['initials']}}</a>
					</div>
@endisset
					<div class="right">
						<small>Total Prize Pool:</small>
						${{$total_pot}}
					</div>
				</h1>

				<div class="log_line">
					Their fancy doctors say the 16th of November. When do <i>you</i> think
					John and Caitlin's newborn will arrive?
				</div>

				<div class="call_to_action">Pick a date below and bid!</div>

				<div class="calendar">
					<div class="days-of-week">
						<div class="day"></div>
						<div class="day">M<span class="not-mobile">onday</span></div>
						<div class="day">T<span class="not-mobile">uesday</span></div>
						<div class="day">W<span class="not-mobile">ednesday</span></div>
						<div class="day">T<span class="not-mobile">hursday</span></div>
						<div class="day">F<span class="not-mobile">riday</span></div>
						<div class="day">S<span class="not-mobile">aturday</span></div>
						<div class="day">S<span class="not-mobile">unday</span></div>
					</div>
@foreach ($calendar as $week)
					<div class="week">
						<div class="day">
	@isset ($week['label'])
		{{ $week['label'] }}
	@endisset
						</div>
	@foreach ($week['days'] as $day)
		@if ($day['inactive'])
			@if ($day['is_due_date'])
						<div class="day disabled highlight">
							<span class="date-string"><span class="fa fa-birthday-cake"></span></span>
			@else
						<div class="day disabled">
							<span class="date-string">{{$day['day_of_month']}}</span>
			@endif
								
			@isset ($bids[$day['date']])
	<?php
		$bid = $bids[$day['date']];
	?>
							<div class="value">${{$bid['value']}}</div>
			@endisset
						</div>
		@else
			@if ($day['is_due_date'])
						<a href="/calendar/{{$day['date']}}" class="day available highlight">
							<span class="date-string"><span class="fa fa-birthday-cake"></span></span>
			@else
						<a href="/calendar/{{$day['date']}}" class="day available">
							<span class="date-string">{{$day['day_of_month']}}</span>
			@endif

			@isset ($bids[$day['date']])
<?php
	$bid = $bids[$day['date']];
?>
							<div class="value">${{$bid['value']}}</div>
			@endisset
						</a>
		@endif
	@endforeach
					</div>
@endforeach
				</div>
@include('templates.nav')
			</div>
@endsection
