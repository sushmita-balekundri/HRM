@extends('layouts.master1')

@section('content')
<div class="container p-3 dashboard">
    <div class="row ml-2 mr-2 mb-2 test">
        <div class="col-md-2 px-3">
            <div><img src="assets/images/avatar.png" width="100px" height="100px"></div>
        </div>
        <div class="col-md-10">
            <div>
                <div style="font-size: 22px;font-weight:600;color:#297bc7 !important">{{ $user->name}}</div>
                <div style="font-size: 12px;line-height: 6px;font-weight: 500;font-family: cursive;">{{ $user->email}} | {{ $user->emp_id }} </div>
                <hr>
                <div class="profile">
                    <table>
                        <tr style="line-height: 10px;">
                            <th width="250px">Designation</th>
                            <th width="250px">Experience </th>
                            <th width="250px">DOJ</th>
                        </tr>
                        <tr>
                            <td>{{ $user->designation }}</td>
                            <td>
                                <?php
                                    $now = date("Y-m-d"); 
                                    $diff = abs(strtotime($now)-strtotime($user->doj));
                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    if($years == 0){
                                        echo $months.' Months,'.$days.' Days';
                                    }elseif($months == 0){
                                    echo $years.' Year,';
                                    }else{
                                        echo $years.' Year,'.$months.' Months';
                                    }   
                                ?>
                            </td>
                            @php $date=date_create($user->doj); @endphp
                            <td>{{date_format($date,"d/m/Y")}}</td>
                            <td class="mobileprobtn"><a style="margin-left:30%;" class="btn btn-sm btn-dark" href="{{route('profile.index')}}">View Profile</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 p-0 ">
            <div class="leave-cal mr-2 ml-4 mt-3 mb-4 dashboard-border">
                <div class="row">
                    <div class="col-4 icon">
                        <i class="far fa-calendar-check fa-5 bg-blue"></i>
                    </div>
                    <div class="col-8 mt-2">
                        <h5>Leaves</h5>
                        @php
                        $success = 0;
                        foreach($leave as $l) {
                        if($l->emp_id == auth()->user()->emp_id) {
                        $success += 1;
                        }
                        }
                        @endphp
                        <b>
                            <h5 class="timer count-title count-number" data-to="{{ $success }}" data-speed="3000"></h5>
                        </b>
                    </div>
                </div>
            </div>
            <div class="event-cal mr-2 ml-4 mt-3 mb-4 dashboard-border">
                <div class="row">
                    <div class="col-4 icon">
                        <i class="far fa-calendar-alt bg-red"></i>
                    </div>
                    <div class="col-8 mt-2">
                        <h5>Events</h5>
                        <h5 class="timer count-title count-number" data-to="{{count($event)}}" data-speed="3000"></h5>
                    </div>
                </div>
            </div>
            <div class="event-cal mr-2 ml-4 mt-3 dashboard-border">
                <div class="row">
                    <div class="col-4 icon">
                        <i class="far fa-calendar-alt bg-dark"></i>
                    </div>
                    <div class="col-8 mt-2">
                        <h5>Leaves</h5>
                        <h5 class="timer count-title count-number" data-to="{{count($event)}}" data-speed="3000"></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 p-0">
            <div class="card1 watchblock mr-4 ml-2 mt-3" style="height: 95.6% !important;">
                
                @php $date = date_default_timezone_set('Asia/Kolkata'); @endphp
                <span class="dayblock">
                    @php 
                        echo $today = date("F j, Y"); 
                        echo "<br>";
                    @endphp 
                </span>
                <span class="imgblockem">
                    <img src="assets/images/watch2.jpg" class="rounded-circle" width="130px" height="130px">
                </span> 
                <span class="greeting">
                    @php
                        $time = date("H");
                        $timezone = date("e");
                    @endphp
                    @if($time < "12") 
                        Good Morning..! <i class="fas fa-coffee"></i>
                    @elseif ($time >= "12" && $time < "17")
                        Good Afternoon..! 
                    @elseif ($time >= "17" && $time < "19")
                        Good Evening..! <i class="fas fa-coffee"></i>
                    @elseif ($time >= "19")
                        Good Night..! 
                    @endif
                </span> 
                <span class="timeblock">
                    @php 
                        echo $today = date("l, ");
                        echo $today = date("g:i a");
                    @endphp 
                </span>	
            </div>
        </div>
        <div class="col-md-4 p-0">
            <div class="row ad mt-2 mr-1">
                <?php $i = 0; ?>
                @foreach ($event as $ev)
                <?php
                $date = date('Y-m');
                $am = date('Y-m', strtotime($ev['start_date']));
                if ($am == $date){
				if($i >= 3) {break;}else{?>
                <div class="col-11 col-md-11 py-2 event-light m-2">
                    <div class="event-lights row">
                        <div class="col-2 col-md-2 p-0">
                            <a href="{{ route('ecalendar') }}" class="text-dark">
                                <i class="far fa-calendar-alt"></i>
                            </a>
                        </div>
                        <div class="col-10 col-md-10 p-0">
                            <h6>{{ $ev->event_name }}</h6>
                            <small>
                                <b>
                                    @php $date=date_create($ev->start_date); @endphp
                                    {{date_format($date,"d/m/Y")}}
                                </b>
                            </small>
                        </div>
                    </div>
                </div>
                <?php $i++; }} endforeach;?>
                <div class="col-1 col-md-1"></div>
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