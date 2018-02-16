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
         
       
<div class="span6">
           
       <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Lista de  NUEVOS</h3>
            </div>
            
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Nombre de la informe </th>
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

             
          </div>
          
        
          
        </div>
         
      </div>
                  
             
          </div>
    </div></div></div>
   
</div>


@endsection