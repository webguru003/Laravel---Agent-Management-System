@extends('layouts.app')

@section('content')
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span8">
                      <div class="widget">
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>
                                   Tabla mensual del informe</h3>
                            </div>
                            
                            <div class="widget-content">
                                <canvas id="bar-chart" class="chart-holder" width="538" height="235px" style="width:100%;">
                                </canvas>
                                
                            </div>
                            
                        </div>   
               <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>Calendario Finalizados</h3>
            </div>
            
            <div class="widget-content">
              <div id='calendar'>
              </div>
            </div>
             
          </div>
                       <div class="widget" style="display:none;" >
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>Gráfico mensual gráfico</h3>
                            </div>
                            
                            <div class="widget-content">
                                <canvas id="area-chart" class="chart-holder" width="538" height="250">
                                </canvas>
                                <!-- /line-chart -->
                            </div>
                            
                        </div> <div class="span6" style="display:none;">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>
                                    Donut Chart</h3>
                            </div>
                            
                            <div class="widget-content">
                                <canvas id="donut-chart" class="chart-holder" width="538" height="250">
                                </canvas>
                                
                            </div>
                            
                        </div>
                        
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>
                                    A Chart</h3>
                            </div>
                            
                            <div class="widget-content">
                                <canvas id="line-chart" class="chart-holder" width="538" height="250">
                                </canvas>
                                <!-- /-chart -->
                            </div>
                            
                        </div>
                        
                    </div>        
                        
                        
 </div>
        <div class="span4">
        <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Informes Finalizados Hoy</h3>
            </div>
            @php
             $todaycomplete = App\Task::where('completion_date', date('Y-m-d'))->count();
             $todaycopletedate = App\Task::where('completion_date', date('Y-m-d'))->first();
                 if($todaycomplete > 0 )
                 {
                    $todaycopletedate_url=url('/task/completed/'.$todaycopletedate->completion_date);
                 }
                 else
                 {
                 	$todaycopletedate_url="#";
                 }
             
            @endphp
            <div class="widget-content">
              <div id="big_stats" class="cf">
               <div class="stat"> 
              <a href="{{$todaycopletedate_url}}"> <i class="icon-tasks"></i> <span class="value" style="font-size: 24px;"></a>
               {{$todaycomplete}}<br>
<br>
</span> </div>
                      </div>
              </div>
             
          </div>
                    
                    
                    <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Alertas importantes</h3>
            </div>
            
            <div class="widget-content">
               <table class="table table-striped table-bordered">
                <tbody>
<?php
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
?>
                  @php
                    
                    $newtasks = App\Task::where([
                    ['status', '!=', 'facturada']
                    ])->get();
                    @endphp 
                    
                  @foreach($newtasks as $newtask)

                  @php
	                  $date1 = date('Y-m-d');
	                  $date2 = $newtask->due_date; //today's date  
	                  $daysArray = getNumberOfDays($date1, $date2);
                  @endphp


                  @if(count($daysArray) <= 2 && count($daysArray) > 0)
                  <tr>
                  <td> {{$newtask->title}} Expediente <br>
                  <span class="blink">{{count($daysArray)}} days 
                  Sólo días</span>
                  </td>
                  </tr>

                  @endif
                  @endforeach
                 
                 </tbody>
              </table>
              </div>
             
          </div>    
                         
                        
                     
                    
                    
                </div> 
 </div>
 <div class="row">
                    
        
         
        
  </div>
         
       
    </div></div>
   
</div>
<?php 
$tasks=App\Task::select('completion_date')->where('completion_date','!=', "")->distinct()->get();
	$taskcompleted = "";
	if(count($tasks) > 0)
	{
		foreach($tasks as $task)
		{
				$count = App\Task::where('completion_date', $task->completion_date)->count();
				$ymd = explode("-",$task->completion_date);
				$month = $ymd[1]-1;
				$url=url('/task/completed/'.$task->completion_date);
				$taskcompleted = $taskcompleted."	 						{
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
				[DB::raw('DATE(created_at)'),'=', $date]
			])->count();
		
			$ymd = explode("-",$date);
			$month = $ymd[1]-1;
			$url=url('/task/created_at/'.$date);
			$taskcreated = $taskcreated."	 						{
							  
							  backgroundColor: '#0000ff',
							  title: '".$count." Nuevo',
							  start: new Date(".$ymd[0].", ".$month.",".$ymd[2]." ),
							  end: new Date(".$ymd[0].", ".$month.",".$ymd[2]." ),
							  url:'".$url."'
							},";
			
	}
}
/*bar chart data*/
 $month_spanish='"enero","feb","marzo","marzo","mayo","jun","jul","agosto","set","oct","nov","dic"'; 

$month_name_data="";
$month_count="";
for ($i=1; $i<=12; $i++) 
{ 
$month= $i;
$year= date('Y');
$monthName = date("F", mktime(0, 0, 0, $month, 10));
$shortmonthName = substr($monthName, 0, 3);
$count=App\Task::where([
      ['completion_date', 'like', '%'.$year.'-'.$month.'-'.'%']
        ])->count();
$month_name_data=$month_name_data.'"'.$shortmonthName.'",';
$month_count=$month_count.$count.',';
}
/*bar chart data*/				  
?> 
<script>

var barChartData = {

            labels: [<?php echo $month_spanish; ?> ],
            datasets: [
                {
            
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    data: [<?php echo substr($month_count, 0, -1); ?>]
                }
            ]

        }
  var ctx =document.getElementById("bar-chart").getContext("2d");
var myLine = new Chart(ctx).Bar(barChartData, { responsive : true });
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
