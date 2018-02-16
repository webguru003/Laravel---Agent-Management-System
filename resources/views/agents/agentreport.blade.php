@extends('layouts.app')
@section('title', '')
@section('content')
<style type="text/css">
  button.btn, input[type="submit"].btn {
    margin-bottom: 10px;
}
</style>
@php
function getNumberOfDays($startDate, $endDate, $hoursPerDay="7.5", $excludeToday=true)
{
    // d/m/Y
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $oneday = new DateInterval("P1D");

    $days = array();

    /* Iterate from $start up to $end+1 day, one day in each iteration.
    We add one day to the $end date, because the DatePeriod only iterates up to,
    not including, the end date. */
    foreach(new DatePeriod($start, $oneday, $end->add($oneday)) as $day) {
        $day_num = $day->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
        if($day_num < 6) { /* weekday */
            $days[$day->format("Y-m-d")] = $hoursPerDay;
        } 
    }    

     if ($excludeToday)
        array_pop ($days);  

    return $days;       
}

$agents = App\User::where('typeid','=', 2)->get();
@endphp
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
@php $loop_count=0; @endphp
@foreach($agents as $agent)

		<div class="span6">
		<div class="widget action-table">
		<div class="widget-header"> <i class="icon-th-list"></i>
		<h3>{{ucfirst($agent->  username)}}  Informes</h3>
		</div>

		<div class="widget-content">
		@php
		$total_assigned = App\Task::where([
		['assign_to', $agent->id],['status','!=', ""],
		])->count();
    $total_pending = App\Task::where([
    ['assign_to', $agent->id],['status','=', "enproceso"],
    ])->count();

		$total_newtasks = App\Task::where([
		['assign_to', $agent->id],['status','=', "nuevoexpeditene"],
		])->count();

		$total_completed = App\Task::where([
		['assign_to', $agent->id],['status','=', "facturada"],
		])->count();
		$total_completed_tasks = App\Task::where([
		['assign_to', $agent->id],['status','=', "facturada"],
		])->get();
		$total_not_completed_intime=0;
		foreach($total_completed_tasks as $task)
		{
			 
			$date1 = $task->task_startdate;
			$date2 =  $task->completion_date; 
			$daysArray = getNumberOfDays($date1, $date2);
          	if(count($daysArray) > 14 && count($daysArray) > 0)
          	{
              $total_not_completed_intime++; 
          	}

		}
		@endphp
		<button class="btn btn-info">Total Informes  :{{$total_assigned}}</button><br>
    <button class="btn btn-newtask">Informes Nuevos :{{$total_newtasks}}</button> <br>
		<button class="btn btn-inprocess">Informes Pendientes : {{$total_pending}}</button> <br>
		<button class="btn btn-danger">Informes Fuera De Plazo : {{$total_not_completed_intime}} </button><br>
		<button class="btn btn-billed">Informes Finalizados  : {{$total_completed}}</button><br>
		</div> 

    <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>Calendario Finalizados</h3>
            </div>
            
            <div class="widget-content">
              <div id="calendar_{{$loop_count}}">
              </div>
            </div>
             
          </div>  

		</div>
	
		   
		
		
		</div><!-- span4 -->
@php
$tasks=App\Task::select('completion_date')->where([
['assign_to', $agent->id],['completion_date','!=', ""]
])->distinct()->get();
  $taskcompleted = "";
  foreach($tasks as $task)
  {
    $count = App\Task::where([
      ['assign_to', $agent->id],['completion_date', $task->completion_date]
    ])->count();
    $ymd = explode("-",$task->completion_date);
    $month = $ymd[1]-1;
    $url=url('/task/completed/'.$task->completion_date.'/'.$agent->id);
    $taskcompleted = $taskcompleted."             {
              backgroundColor: '#000000',
              title: '".$count." Expediente',
              start: new Date(".$ymd[0].", ".$month.",".$ymd[2]." ),
              end: new Date(".$ymd[0].", ".$month.",".$ymd[2]." ),
              url:'".$url."'
            },";    
  }
@endphp
<script type="text/javascript">
$(document).ready(function() {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
        
                var calendar = $('#calendar_'+<?php echo $loop_count; ?>).fullCalendar({
                  header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                  },

                  selectable: false,
                  selectHelper: true,
                  select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                      calendar.fullCalendar('renderEvent',
                        {
                          title: title,
                          start: start,
                          end: end,
                          allDay: allDay
                        },
                        true // make the event "stick"
                      );
                    }
                    calendar.fullCalendar('unselect');
                  },
                  editable: true,
             events: 
                    [ 
                      <?php echo  substr($taskcompleted, 0, -1); ?>
                    ]

                });
      });

</script>

@php $loop_count++ @endphp
@endforeach
</div><!-- row -->
</div><!-- container -->
</div><!-- main-inner -->
</div><!-- main -->

@endsection