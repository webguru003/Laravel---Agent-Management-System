@extends('layouts.teamindex')
@section('title', '')
@section('content')
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
@endphp
<style type="text/css">
.led-red {
 margin:0px;
 float: right;
  width: 24px;
  height: 24px;
  background-color: #F00;
  border-radius: 50%;
  box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 12px;
  -webkit-animation: blinkRed 0.5s infinite;
  -moz-animation: blinkRed 0.5s infinite;
  -ms-animation: blinkRed 0.5s infinite;
  -o-animation: blinkRed 0.5s infinite;
  animation: blinkRed 0.5s infinite;
}

@-webkit-keyframes blinkRed {
    from { background-color: #F00; }
    50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
    to { background-color: #F00; }
}

</style>
<div class="main">
  <div class="main-inner">
    <div class="container">
      
    <div class="widget widget-table action-table">
    <div class="row">
         
       
<div class="span4">
           
       <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Lista de  NUEVOS</h3>
            </div>
            
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Riesgo</th>
                     <th style="text-align:right; width:80px;"> </th>
                  </tr>
                </thead>
                <tbody>
                @foreach($newtasks as $newtask)
                <tr>
                <td> {{$newtask->title}}
                  @php
                  $date1 = date('Y-m-d');
                  $date2 =  $newtask->due_date; 
                  $daysArray = getNumberOfDays($date1, $date2);
                  @endphp
                  @if(count($daysArray) <= 2 && count($daysArray) >= 0)
                  <div class="led-red"></div>
                  @endif
                
                </td>
                <td align="right" style="text-align:right; width:80px;"><a href="{{url('/team/tasks/'.$newtask->id)}}" class="btn btn-small btn-success">VER</a></td>
                  </tr>
               @endforeach   
                </tbody>
              </table>
            </div>
             
          </div>
          
        </div>
<div class="span4">
           
       <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Lista de  Pendientes</h3>
            </div>
            
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Riesgo</th>
                    <th style="width:100px;"></th>
                     <th style="text-align:right; width:80px;"> </th>
                  </tr>
                </thead>
                <tbody>
                @foreach($inprocesstasks as $inprocesstask)
                <tr>
                <td> {{$inprocesstask->title}}</td>
                <td style="width:100px;">
               
                @if($inprocesstask->status=="enproceso")
                <button class="btn btn-small btn-inprocess">EN PROCESO</button>
                @elseif($inprocesstask->status=="visitaconcertada")
                <button class="btn btn-small btn-info">Visita Concertada</button> 
                @elseif($inprocesstask->status=="enmienda")
                <button class="btn btn-small btn-enmienda">ENMIENDA</button>
                @elseif($inprocesstask->status=="noresponde")
                <button class="btn btn-small btn-info">NO RESPONDE</button> 
                @elseif($inprocesstask->status=="reunionfija")
                <button class="btn btn-small btn-info">VISITA CONCERTADA</button> 
                @endif 
                
                </td>
                <td align="right" style="text-align:right; width:80px;"><a href="{{url('/team/tasks/'.$inprocesstask->id)}}"  class="btn btn-small btn-success">VER</a></td>
                  </tr>
               @endforeach  
                </tbody>
              </table>
            </div>
             
          </div>
          
        </div><div class="span4">
           
       <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Lista de  Finalizados</h3>
            </div>
            
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Riesgo</th>
                     
                  </tr>
                </thead>
                <tbody>
                @foreach($closedtasks as $closedtask)
                <tr>
                <td> {{$closedtask->title}}  </td>
                  </tr>
               @endforeach  
                </tbody>
              </table>
            </div>
             
          </div>
          
        </div>
         
      </div>
                  <div class="row">
                    <div class="span12">
                        <div class="widget widget-nopad">
                          <div class="widget-header"> <i class="icon-list-alt"></i>
                          <h3>Calendario</h3>
                          </div>

                          <div class="widget-content">
                            <div id='calendar'>
                          </div>
                        </div>
                      </div>
                </div>
             
          </div>
    </div></div></div>
   
</div>
<?php 
$tasks=App\Task::select('completion_date')->where([
  ['completion_date','!=', ""],
  ['assign_to', '=', $assign_to[0]]
])->distinct()->get();
  $taskcompleted = "";
  if(count($tasks) > 0)
  {
    foreach($tasks as $task)
    {
        $count = App\Task::where([
          ['completion_date', $task->completion_date],
          ['assign_to', '=', $assign_to[0]]
        ])->count();
        $ymd = explode("-",$task->completion_date);
        $month = $ymd[1]-1;
        $url=url('#');
        $taskcompleted = $taskcompleted."             {
                  backgroundColor: '#000000',
                  title: '".$count." Finalizado',
                  start: new Date(".$ymd[0].", ".$month.",".$ymd[2]." ),
                  end: new Date(".$ymd[0].", ".$month.",".$ymd[2]." ),
                  url:'".$url."'
                },";
        
        
    }
  }
$tasks=App\Task::select(DB::raw('DATE(created_at)  as created_at'))->where([
['status','=', "nuevoexpeditene"],
['assign_to', '=', $assign_to[0]]
])->distinct('created_at')->get();
$taskcreated = "";
if(count($tasks) > 0)
{
  foreach($tasks as $task)
  {
      
      $timestamp = strtotime($task->created_at);
      $date= date('Y-m-d',$timestamp);
      $count = App\Task::where([
        ['status','=', "nuevoexpeditene"],
        ['assign_to', '=', $assign_to[0]],
        [DB::raw('DATE(created_at)'),'=', $date]
      ])->count();
    
      $agent_id= trim($assign_to[0], '[]');
      $ymd = explode("-",$date);
      $month = $ymd[1]-1;
      $url=url('/team/'.$agent_id.'/task/created_at/'.$date);
      $taskcreated = $taskcreated."             {
                
                backgroundColor: '#0000ff',
                title: '".$count." Nuevo',
                start: new Date(".$ymd[0].", ".$month.",".$ymd[2]." ),
                end: new Date(".$ymd[0].", ".$month.",".$ymd[2]." ),
                url:'".$url."'
              },";
      
  }
}
?>
<script type="text/javascript">
     $(document).ready(function() {
          var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
        
                var calendar = $('#calendar').fullCalendar({
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
                      <?php echo   $taskcreated.substr($taskcompleted, 0, -1); ?>
                    ]
        });
      });
</script>
@endsection