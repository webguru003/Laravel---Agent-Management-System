@extends('layouts.app')
@section('title', 'Añadir')
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
<link href="{{asset('datatable/excel-bootstrap-table-filter-style.css')}}" rel="stylesheet" type="text/css" />
 <script src="{{ asset('datatable/datatables.min.js') }}"></script>
<script src="{{ asset('datatable/excel-bootstrap-table-filter-bundle.js') }}"></script>
<script src="{{ asset('datatable/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('datatable/moment.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
 <script type='text/javascript'>//<![CDATA[
window.onload=function(){
// Bootstrap datepicker
$('.input-daterange input').each(function() {
  $(this).datepicker('clearDates');
});

// Set up your table

table = $('#table').DataTable({
  paging: true,
  pageLength: 25,
  info: true,
  ordering: false,
  columnDefs: [
    { searchable: false, targets: 6 }
  ]
});

var index=0;
changeValues(index);

$('#table')
        .on( 'click', 'th', function () {

 var tfhisclass = $(this).attr("datahighlight");  
 
              $('th').removeClass( 'thhighlight' );
              $(this).addClass( 'thhighlight' );
             $('td').removeClass( 'highlight' );
            $('.'+tfhisclass).removeClass( 'highlight' );
            $('.'+tfhisclass).addClass( 'highlight' );
        } );

// Extend dataTables search
$.fn.dataTable.ext.search.push(
  function(settings, data, dataIndex) {
	 var min0 = $('#min-date').val();
     var max0 = $('#max-date').val();
	  
	  var min1 = min0.split("-");
      var max1 = max0.split("-");

       var min2 = min1[2]+"-"+min1[1]+"-"+min1[0];
      var max2 = max1[2]+"-"+max1[1]+"-"+max1[0];

if(min0 == '' && max0 =='') {min2='';max2=''; }
    var min = min2;
    var max = max2;

    
    var createdAt = data[4] || 0; // Our date column in the table

    if (
      (min == "" || max == "") ||
      (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
    ) {
      return true;
    }
    return false;
  }
);

/*$('#table').on( 'page.dt', function () {
    var info=table.page.info();
    index=info.page+1;
    alert(index);
   changeValues(index); 

});*/


// Re-draw the table when the a date range filter changes
$('.date-range-filter').change(function() {
    table.draw();
    changeValues(index);
});
$('.dropdown-filter-menu-item').change(function() {
  table.draw();
changeValues(index);
        
});

$('.last1month').click(function() {
	<?php
	$todaydate = date("d-m-Y");
	 $lastonemonth =  date("d-m-Y",strtotime("-1 month")); 
	$lasttwomonth =  date("d-m-Y",strtotime("-2 month"));
	$lastthreemonth =  date("d-m-Y",strtotime("-3 month"));  ?>
	document.getElementById('min-date').value='<?php echo $lastonemonth; ?>';
	document.getElementById('max-date').value='<?php echo $todaydate; ?>';
   table.draw();
changeValues(index);

});
$('.last2month').click(function() {
	document.getElementById('min-date').value='<?php echo $lasttwomonth; ?>';
	document.getElementById('max-date').value='<?php echo $todaydate; ?>';
   table.draw();
   changeValues(index);
});
  $('.last3month').click(function() {
  	document.getElementById('min-date').value='<?php echo $lastthreemonth; ?>';
  	document.getElementById('max-date').value='<?php echo $todaydate; ?>';
     table.draw();
    changeValues(index);

});
$('.reset').click(function() {
	document.getElementById('min-date').value='';document.getElementById('max-date').value='';
   table.draw();
   changeValues(index);
});

$('#my-table_filter').hide();
}//]]> 


   function changeValues(index){  
    document.getElementById("dataforexport").value ='';
      var table = document.getElementsByTagName("table");
      var cells = table[index].getElementsByTagName("tr");
      document.getElementById("dataforexport").value = '';
      for (var i = 1; i < cells.length; i++) {
      
      var ceeell = cells[i].style.display;
      if(ceeell == "none")
        {}
        else
        {

document.getElementById("dataforexport").value = document.getElementById("dataforexport").value  + cells[i].getElementsByTagName('td')[0].innerHTML +",";

        }
      }
     };
</script>
<style type="text/css">
.highlight {background-color: #EEEEEE !important;}
.delete-btn span{display: none;}
</style>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
         
       
 
<div class="12" style="margin:0px !important;">
<a href="{{url('/tasks/create')}}"><button class="btn btn-primary" style="float:right;">Nuevo Informe</button></a><br>
<br>
</div>


        <div class="span12" style="margin:0px !important; >
           
       <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Lista de Informes </h3>
            </div>
            
    <div class="widget-content" style="min-height: 600px;">
    <div class="pull-right col-md-5">
    <div class="input-group input-daterange" style="float: right;
    position: relative;
    top: 23px;
    right: 15px;"><a class="reset" >Reiniciar</a> | <a class="last1month" >El mes pasado</a> | <a class="last2month" >Últimos 2 meses</a> | <a class="last3month" >Últimos 3 meses</a>
     
    <input type="text" id="min-date" class="form-control date-range-filter span2" data-date-format="dd-mm-yyyy" placeholder="De:">
    
     
    <input type="text" id="max-date" class=" span2 form-control date-range-filter" data-date-format="dd-mm-yyyy" placeholder="A:">
    
    </div>
    </div>
              <table id="table" class="table table-striped table-bordered table-intel">
                <thead>
                  <tr>
                    <th datahighlight="col1">N/REF</th>
                    <th datahighlight="col2"> REF.ARAG</th>
                    <th datahighlight="col3" style="width: 120px;">RIESGO</th>
                     <th datahighlight="col4">PERITO</th>
                    <th style="display:none;" datahighlight="col5">VENCIMIENTO</th>
                    <th datahighlight="col6"  class="removesorting">VENCIMIENTO</th>
                    <th class="delete-btn">Fecha Visita </th>
                    <th datahighlight="col7">ESTADO</th>
                    @if(!isset( $alert['novalue']))
                      <th datahighlight="col8">ALERTA 1</th>
                        @if(isset($alert['newtask']))
                        @else
                        <th datahighlight="col9">ALERTA 2</th>
                        @endif
                    @endif
                     <th class="delete-btn" > </th>
                  </tr>
                </thead>
                <tbody>
      @if(count($tasks) > 0)
        @foreach($tasks as $task) 
				<tr>
				
					<td class="col1">{{$task->dia_id}}</td>
					<td class="col2">{{$task->reference_number}}</td>
					<td class="col3">{{$task->title}}</td>
 					<td class="col4">
					  @php $agent = App\User::where('id', $task->assign_to)->first();
            echo $agent->fname;
            @endphp
					 </td>
           <td style="display:none;" class="col5">
           {{$task->due_date}}
           </td>
           <td class="dud2 col6"><span style="display:none;">{{$task->due_date}}</span>
           <?php $duedatevalue = explode("-",$task->due_date); echo $duedatevalue[2]."-".$duedatevalue[1]."-".$duedatevalue[0];?>
           </td>
           <td style="text-align: center;">
           
           @if(isset($task->meeting_date))
             @php 
             $meeting_date = explode("-",$task->meeting_date);  
             $meeting_date=$meeting_date[2]."-".$meeting_date[1]."-".$meeting_date[0];
             @endphp
          <input type="checkbox" name="remember_meeting" class="remember_checked" value="{{$task->id}}" @php if(isset($task->meetingfixed)){echo "checked";} @endphp><br>
          <span>{{$meeting_date}}</span><br>
          <span>{{$task->meeting_time}}</span>
          @endif
           
           </td>
					<td class="col7">
					@if($task->status=="nuevoexpeditene") 
          <button class="btn btn-small btn-newtask">NUEVO INFORME</button>
					@elseif($task->status=="enproceso")
					<button class="btn btn-small btn-inprocess">EN PROCESO</button>
          @elseif($task->status=="incicencia")
          <button class="btn btn-small btn-info">INCICENCIA</button>
          @elseif($task->status=="reunionfija")
          <button class="btn btn-small btn-info">VISITA CONCERTADA</button>
          @elseif($task->status=="visitada")
					<button class="btn btn-small btn-closed">VISITADA</button>
          @elseif($task->status=="facturada")
          <button class="btn btn-small btn-billed">FACTURADO</button>  
           @elseif($task->status=="noresponde")
          <button class="btn btn-small btn-info">NO RESPONDE</button> 
           @elseif($task->status=="visitaconcertada")
          <button class="btn btn-small btn-info">VISITA CONCERTADA</button> 
           @elseif($task->status=="enmienda")
          <button class="btn btn-small btn-enmienda">ENMIENDA</button> 
					@endif 
					</td>
@if(!isset( $alert['novalue']))
          <td class="col8">
             @if($task->status=="nuevoexpeditene")
            @php
              $date1 = $task->created_at;
              $date2 =  date('Y-m-d');//today's date  
              $daysArray = getNumberOfDays($date1, $date2);
            @endphp
              @if(count($daysArray) > 2 && count($daysArray) > 0)
                <button class="btn btn-danger btn-small">No visitado</button>
              @endif
          @endif
          </td>
            @if(isset( $alert['newtask']))
            @else
                    <td class="col9">
                      @if($task->status == "enproceso")
                      @php
                        $date1 = $task->task_startdate;
                        $date2 =  date('Y-m-d');//today's date  
                        $daysArray = getNumberOfDays($date1, $date2);
                      @endphp
                        @if(count($daysArray) > 14 && count($daysArray) > 0)
                          <button class="btn btn-danger btn-small">14 días</button>
                        @endif
                    @endif 
                    </td>
            @endif
@endif
					<td class="">
                  @if($task->status == "facturada")
                    @php $invoice = App\Invoice::where('task_id', $task->id)->first(); @endphp 
                    <a href="{{url("/invoices/print/$invoice->id")}}" class="btn btn-small btn-invert">FACTURA</a>
                  @endif
           <a href="{{url("/tasks/$task->id/edit")}}" class="btn btn-small btn-success">EDITAR</a>
            <form action="{{url("/tasks/$task->id")}}" method="POST" style="display:inline;">
              {!! method_field('DELETE') !!}
              {{ csrf_field() }}
              <button class="btn btn-danger btn-small confirmation" @php if($task->status=="facturada"){echo "disabled";} @endphp>BORRAR</button>
            </form>
					</td>
                  </tr>
              @endforeach
      @endif
                </tbody>
              </table>


              <form action="#" method="post" id="dataid_form">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" id="dataforexport" name ="dia_ids" value="" style="width: 600px;">
                </form>
        <div class="buttons" style="text-align:right;position: relative;bottom: 50px;">
          <a id="exportpdf"  class="btn  btn-small btn-info" >EXPORTAR A EXCEL</a>&nbsp;&nbsp;
          
        </div>


            </div>
             
          </div>
		  
        </div>
         
      </div>
       
    </div></div><div id="display"></div>
   
</div>
 <style>
 .dud2 span { display:none;}
  table.dataTable {
    
     margin-top: 0px !important; 
     margin-bottom: 0px !important; 
 }
  .sorting_disabled { background-color:#EEEEEE; }
  .form-control {margin: 0px;}
   .form-inline label {justify-content: left; }
  #table_filter { display:none;}
  .row { padding:0px;margin:0px;}
  .col-md-12{padding: 0px;}
  #table_length {
    padding: 15px;
}
.dataTables_paginate,.dataTables_info { padding:15px;}
.table .td-actions .dropdown-filter-dropdown { visibility:hidden;}
  </style>
  <script>
$("#exportpdf").click(function()
{
  event.preventDefault();
  var url ="<?php echo url('/export/to/excel'); ?>";
  $('#dataid_form').attr('action', url);
  $( "#dataid_form" ).submit();
});


     $(function () {
      // Apply the plugin 
      $('#table').excelTableFilter();
    });

$("input[type='checkbox'].remember_checked").click(function() {
    if($(this).is(":checked"))
      {
         var taskid= $(this).attr("value");
         var meetingfixed=1;
         meetingRemember(taskid,meetingfixed);
      }
      else if($(this).not(':checked'))
      {
        var taskid= $(this).attr("value");
         var meetingfixed=null;
         meetingRemember(taskid,meetingfixed);
      }


});

function meetingRemember(taskid,meetingfixed)
{
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var url = "<?php echo url('/task/meeting/remember'); ?>";
  $.ajax({
    type: "POST",
    url: url,
    data: {
    'taskid' :taskid, 'meetingfixed' :meetingfixed
    },
    success: function(data)
    {         
      console.log(data);
    },

    error: function(data)
    {
      console.log(data.responseText);
    }

  });

}
  </script>
@endsection