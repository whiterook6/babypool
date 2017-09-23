@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Charts')

@section('content')
			<div class="container">
				<h1>
					Baby Pool
					<small>for John and Caitlin</small>	
				</h1>

				<canvas id="bid-paid-bar-chart"></canvas>
				<canvas id="bids-cumulative"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"
	integrity="sha256-UGwvyUFH6Qqn0PSyQVw4q3vIX0wV1miKTracNJzAWPc="
	crossorigin="anonymous"></script>
<script>
var colors = {
	pink: '#FF3D7F',
	green: '#00A388',
	yellow: '#FFFF9D',
}

var bidPaidBarChart = {
	labels: [
		"September 1st",
		"September 16th",
		"October 1st",
		"October 16th",
		"November 1st",
		"November 16th",
	],
	datasets: [{
		label: 'Paid',
		backgroundColor: colors.green,
		data: [
			15,
			45,
			60,
			60,
			60,
			103
		]
	}, {
		label: 'Unpaid',
		backgroundColor: colors.yellow,
		data: [
			15,
			60,
			60,
			103,
			150,
			157
		]
	}]

};

var bidsCumulative = {
	type: 'line',
    data: {
        labels: [
			"September 1st",
			"September 16th",
			"October 1st",
			"October 16th",
			"November 1st",
			"November 16th",
		],
        datasets: [{
            label: "My First dataset",
            backgroundColor: colors.pink,
            borderColor: colors.pink,
            data: [
                5,
                7,
                15,
                18,
                19,
                19,
                26
            ],
            fill: false,
            lineTension: 0,
        }]
    },
    options: {
        responsive: true,
        title:{
            display:true,
            text:'Chart.js Line Chart'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        }
    }
};
window.onload = function() {
	Chart.defaults.global.defaultFontFamily = 'Source Sans Pro';

	new Chart(document.getElementById("bid-paid-bar-chart").getContext("2d"), {
		type: 'bar',
		data: bidPaidBarChart,
		options: {
			title:{
				display:true,
				text:"Total Pool Size"
			},
			responsive: true,
			scales: {
				xAxes: [{
					stacked: true,
				}],
				yAxes: [{
					stacked: true
				}]
			},
		}
	});

	new Chart(document.getElementById("bids-cumulative").getContext("2d"), bidsCumulative);
};
</script>
@include('templates.nav')
			</div>
@endsection
