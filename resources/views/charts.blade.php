@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Charts')

@section('content')
			<div class="container">
				<h1>
					Charts
					<small>and Statistics</small>
				</h1>

				<div class="row statistics">
					<div class="col-md-4">
						<div class="legend">Top Bidders by Total</div>

@foreach($top_users_by_value as $user)
						<div>
							{{$user['initials']}}: ${{$user['total_value']}}
						</div>
@endforeach
					</div>
					<div class="col-md-4">
						<div class="legend">Top Bidders by Count</div>

@foreach($top_users_by_bid_count as $user)
						<div>
							{{$user['initials']}}: {{$user['count']}}
						</div>
@endforeach
					</div>

					<div class="col-md-4">
						<div class="legend">Top Dates by Total</div>

@foreach($top_dates_by_value as $top_date)
						<div>
							<a href="/calendar/{{$top_date['date']}}">
								{{$top_date['date']}}
							</a>: ${{$top_date['total_value']}}
						</div>
@endforeach
					</div>

				</div>
				<div class="row statistics">
					<div class="col-md-4">
						<div class="legend">
							Average labor and delivery
						</div>
						<div class="datum">
							14h
						</div>
						<a class="source" href="http://www.parents.com/pregnancy/giving-birth/labor-and-delivery/labor-childbirth-phases/">Source</a>
					</div>
					<div class="col-md-4">
						<div class="legend">
							Expected delivery date
						</div>
						<div class="datum">
							<a href="/calendar/2017-11-16">November 16th</a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="legend">
							Average mass of newborns
						</div>
						<div class="datum">
							3.5kg
						</div>
						<a class="source" href="https://www.healthlinkbc.ca/health-topics/te6295">Source</a>
					</div>
				</div>
				<div class="row statistics">
					<div class="col-md-4">
						<div class="legend">
							Standard deviation from due date
						</div>
						<div class="datum">
							9.6 days (66%)
						</div>
						<a class="source" href="https://web.archive.org/web/20161229164402/https://spacefem.com/pregnant/charts/duedate1.php">Source (archive)</a>
					</div>
					<div class="col-md-4">
						<div class="legend">
							Mean length of pregnancy
						</div>
						<div class="datum">
							278 days
						</div>
						<a class="source" href="https://web.archive.org/web/20161229164402/https://spacefem.com/pregnant/charts/duedate1.php">Source (archive)</a>
					</div>
					<div class="col-md-4">
						<div class="legend">
							Average height of newborns
						</div>
						<div class="datum">
							51cm (20in)
						</div>
						<a class="source" href="https://www.healthlinkbc.ca/health-topics/te6295">Source</a>
					</div>
				</div>
				<div class="row statistics">
					<div class="col-12">
						<div class="legend">Distribution of spontaneous birth dates from due date</div>
						<canvas
							id="term-length-distribution"
							class="chart"
							style="height: 500px"></canvas>
						<a class="source" href="https://web.archive.org/web/20161229164402/https://spacefem.com/pregnant/charts/duedate1.php">Source (archive)</a>
					</div>
				</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"
	integrity="sha256-UGwvyUFH6Qqn0PSyQVw4q3vIX0wV1miKTracNJzAWPc="
	crossorigin="anonymous"></script>
<script>
var colors = {
	pink: '#FF3D7F',
	green: '#00A388',
	yellow: '#FFFF9D',
}

var term_length = {
	type: 'line',
	data: {
		labels: [
			'-20 days',
			'-19 days',
			'-18 days',
			'-17 days',
			'-16 days',
			'-15 days',
			'-14 days',
			'-13 days',
			'-12 days',
			'-11 days',
			'-10 days',
			'-9 days',
			'-8 days',
			'-7 days',
			'-6 days',
			'-5 days',
			'-4 days',
			'-3 days',
			'-2 days',
			'-1 day',
			'Due Date',
			'1 day',
			'2 days',
			'3 days',
			'4 days',
			'5 days',
			'6 days',
			'7 days',
			'8 days',
			'9 days',
			'10 days',
			'11 days',
			'12 days',
			'13 days',
			'14 days',
			'15 days',
			'16 days',
			'17 days',
			'18 days',
			'19 days',
			'20 days',
			'21 days',
		],
		datasets: [{
			label: 'Percentage born',
			backgroundColor: colors.pink,
			borderColor: colors.pink,
			fill: false,
			lineTension: 0,
			data: [
				0.68,
				0.72,
				0.87,
				1.08,
				0.97,
				1.36,
				1.54,
				1.36,
				1.50,
				1.95,
				2.47,
				2.14,
				2.58,
				3.16,
				2.92,
				2.96,
				3.79,
				4.11,
				4.00,
				4.61,
				5.92,
				5.26,
				4.45,
				4.20,
				3.91,
				4.05,
				4.18,
				4.06,
				3.14,
				2.46,
				2.42,
				1.70,
				1.27,
				1.12,
				0.79,
				0.34,
				0.30,
				0.26,
				0.13,
				0.11,
				0.10,
				0.12,
			]
		}]
	},
	options: {
		title: false,
		scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Days from Due Date'
				}
			}],
			yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: '% Born'
				}
			}]
		}
	}
};

window.onload = function() {
	Chart.defaults.global.defaultFontFamily = 'Source Sans Pro';
	var chart = new Chart(
		document.getElementById('term-length-distribution').getContext('2d'),
		term_length
	);
	chart.height = 500;
};
</script>
@include('templates.nav')
			</div>
@endsection
