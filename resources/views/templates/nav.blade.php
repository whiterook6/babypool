<div class="row">
				<div class="col-12 form">
					<a class="button inline"
						href="/calendar">Calendar</a>
					<a class="button inline"
						href="/rules">Rules</a>
@if(isset($user))
					<a class="button inline"
						href="/me">Your Bids</a>
					<a class="right button inline"
						href="/logout">Log Out</a>
@else
					<a class="right button inline"
						href="/login">Log In</a>
@endif
				</div>
			</div>