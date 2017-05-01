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
						<tr>
							<td class="month">April</td>
							<td class="date disabled">
								<span class="day">26</span>
								<span class="fa fa-check"></span>
								<span class="value">$55</span>
							</td>
							<td class="date disabled">
								<span class="day">27</span>
							</td>
							<td class="date disabled">
								<span class="day">28</span>
							</td>
							<td class="date disabled">
								<span class="day">29</span>
							</td>
							<td class="date disabled">
								<span class="day">30</span>
								<span class="fa fa-check"></span>
								<span class="value">$55</span>
							</td>
							<td class="date disabled">
								<span class="day">31</span>
								<span class="fa fa-check"></span>
								<span class="value">$55</span>
							</td>
							<td class="date available">
								<span class="day">1</span>
								<span class="fa fa-check"></span>
								<span class="value">$55</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
@endsection