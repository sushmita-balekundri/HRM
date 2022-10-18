@extends('layouts.master2')

@section('content')
<div class="container p-4 dashboard">
	<div class="row">
		<div class="col-12 col-md-3">
			<div class="dashboard-border">
				<div class="row">
					<div class="col-5 icon">
						<i class="fas fa-user bg-green"></i>
					</div>
					<div class="col-7 mt-2">
						<h5>Employee</h5>
						<b>
							<h5 class="timer count-title count-number" data-to="{{ count($user) }}" data-speed="3000"></h5>
						</b>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-3">
			<div class="dashboard-border">
				<div class="row">
					<div class="col-5 icon">
						<i class="far fa-address-card fa-5 bg-red"></i>
					</div>
					<div class="col-7 mt-2">
						<h5>System</h5>
						<b>
							<h5 class="timer count-title count-number" data-to="170" data-speed="4000"></h5>
						</b>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-3">
			<div class="dashboard-border">
				<div class="row">
					<div class="col-5 icon">
						<i class="far fa-calendar-alt bg-blue"></i>
					</div>
					<div class="col-7 mt-2">
						<h5>Events</h5>
						<b>
							<h5 class="timer count-title count-number" data-to="{{count($event)}}" data-speed="4000"></h5>
						</b>
					</div>
				</div>

			</div>
		</div>
		<div class="col-12 col-md-3">
			<div class="dashboard-border">
				<div class="row">
					<div class="col-5 icon">
						<i class="fas fa-hand-holding-usd bg-black"></i>
					</div>
					<div class="col-7 mt-2">
						<h5>Payroll</h5>
						<b>
							<h5 class="timer count-title count-number" data-to="300" data-speed="4000"></h5>
						</b>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container p-0 mt-4">
		<div class="row">
			<div class="col-md-6">
				<div class="card card1">
					<div class="card-header" style="background-color:#4064a0!important;color:white;font-size:18px;font-weight:600;"style="background-color:#d1a22f!important;color:black;font-size:18px;font-weight:600;"><i class="far fa-user"></i> Employees Stats</div>
					<ul class="list-group list-group-flush">
						<?php 
						$i = 0;?>
						<table class="table table-hover" style="margin-bottom: 0rem !important;">
							<tr class="text-center">
								<th>Id</th>	
								<th>Name</th>	
								<th>Designation</th>	
							</tr>
							@foreach ($user as $emp)
							<?php if($i >= 5) {break;}else{?>
								<tr class="text-center">
									<td>{{ $emp->emp_id }}</td>	
									<td>{{ $emp->name }}</td>	
									<td>{{ $emp->designation }}</td>
								</tr>
							<?php $i++; } endforeach;?>	
						</table>
						<li class="list-group-item text-right"><a href="{{ route('employee.index')}}" class="badge badge-light">View All <i class="fas fa-angle-double-right"></i> </a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card1 watchblock">
					@php $date = date_default_timezone_set('Asia/Kolkata'); @endphp
					<span class="dayblock">
						@php 
							echo $today = date("F j, Y"); 
							echo "<br>";
						@endphp 
					</span> 
					<span class="imgblock">
						<img src="assets/images/watch2.jpg" class="rounded-circle" width="150px" height="150px">
					</span> 
					<span class="timeblock">
						@php 
							echo $today = date("l, ");
							echo $today = date("g:i a");
						@endphp 
					</span>	
					<div class="event-list">
						<div class="ad">
							<?php $i = 0; ?>
							@foreach ($event as $ev)
							<?php
							$date = date('Y-m');
							$am = date('Y-m', strtotime($ev['start_date']));
							if ($am == $date){
							if($i >= 1) {break;}else{?>
							<div class="col-11 col-md-11 py-2 event-light1 m-2">
								<div class="event-lights row">
									<div class="col-2 col-md-2 p-0">
										<a href="{{ route('calendar') }}" class="text-dark">
											<i class="far fa-calendar-alt"></i>
										</a>
									</div>
									<div class="col-10 col-md-10 p-0">
										<h6>{{ $ev->event_name }}</h6>
										<small>
											<b>
												<?php $a = date('d-m-Y', strtotime($ev['start_date']));?>
												{{ $a }}
											</b>
										</small>
									</div>
								</div>
							</div>
							<div class="event-light1-btn"><a href="{{ route('calendar')}}" class="badge badge-light">View All events <i class="fas fa-angle-double-right"></i> </a></li>
							<?php $i++; }} endforeach;?>	
						</div>
					</div>					
				</div>
			</div>	
		</div>
	</div>
</div>


@endsection

@section('scripts')
<script>
	(function($) {
		$.fn.countTo = function(options) {
			options = options || {};
			return $(this).each(function() {
				// set options for current element
				var settings = $.extend({}, $.fn.countTo.defaults, {
					from: $(this).data('from'),
					to: $(this).data('to'),
					speed: $(this).data('speed'),
					refreshInterval: $(this).data('refresh-interval'),
					decimals: $(this).data('decimals')
				}, options);

				// how many times to update the value, and how much to increment the value on each update
				var loops = Math.ceil(settings.speed / settings.refreshInterval),
					increment = (settings.to - settings.from) / loops;

				// references & variables that will change with each update
				var self = this,
					$self = $(this),
					loopCount = 0,
					value = settings.from,
					data = $self.data('countTo') || {};

				$self.data('countTo', data);

				// if an existing interval can be found, clear it first
				if (data.interval) {
					clearInterval(data.interval);
				}
				data.interval = setInterval(updateTimer, settings.refreshInterval);

				// initialize the element with the starting value
				render(value);

				function updateTimer() {
					value += increment;
					loopCount++;

					render(value);

					if (typeof(settings.onUpdate) == 'function') {
						settings.onUpdate.call(self, value);
					}

					if (loopCount >= loops) {
						// remove the interval
						$self.removeData('countTo');
						clearInterval(data.interval);
						value = settings.to;

						if (typeof(settings.onComplete) == 'function') {
							settings.onComplete.call(self, value);
						}
					}
				}

				function render(value) {
					var formattedValue = settings.formatter.call(self, value, settings);
					$self.html(formattedValue);
				}
			});
		};

		$.fn.countTo.defaults = {
			from: 0, // the number the element should start at
			to: 0, // the number the element should end at
			speed: 1000, // how long it should take to count between the target numbers
			refreshInterval: 100, // how often the element should be updated
			decimals: 0, // the number of decimal places to show
			formatter: formatter, // handler for formatting the value before rendering
			onUpdate: null, // callback method for every time the element is updated
			onComplete: null // callback method for when the element finishes updating
		};

		function formatter(value, settings) {
			return value.toFixed(settings.decimals);
		}
	}(jQuery));

	jQuery(function($) {
		// custom formatting example
		$('.count-number').data('countToOptions', {
			formatter: function(value, options) {
				return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
			}
		});

		// start all the timers
		$('.timer').each(count);

		function count(options) {
			var $this = $(this);
			options = $.extend({}, options || {}, $this.data('countToOptions') || {});
			$this.countTo(options);
		}
	});
</script>
@stop