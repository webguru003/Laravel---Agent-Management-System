@extends('layouts.app')
@section('content')
<link href="{{asset('datatable/excel-bootstrap-table-filter-style.css')}}" rel="stylesheet" type="text/css" />
 <script src="{{ asset('datatable/datatables.min.js') }}"></script>
<script src="{{ asset('datatable/excel-bootstrap-table-filter-bundle.js') }}"></script>
<script src="{{ asset('datatable/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('datatable/moment.min.js') }}"></script>
 <script type='text/javascript'>//<![CDATA[
window.onload=function(){
// Bootstrap datepicker
$('.input-daterange input').each(function() {
  $(this).datepicker('clearDates');
});

var table = $('#table').DataTable({
  paging: true,
  pageLength: 25,
  info: true,
  ordering: false,
});

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

  
    var createdAt = data[3] || 0; // Our date column in the table

    if (
      (min == "" || max == "") ||
      (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
    ) {
      return true;
    }
    return false;
  }
);

// Re-draw the table when the a date range filter changes
$('.date-range-filter').change(function() {
    table.draw();
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
});
$('.last2month').click(function() {
	document.getElementById('min-date').value='<?php echo $lasttwomonth; ?>';
	document.getElementById('max-date').value='<?php echo $todaydate; ?>';
   table.draw();
});
$('.last3month').click(function() {
	document.getElementById('min-date').value='<?php echo $lastthreemonth; ?>';
	document.getElementById('max-date').value='<?php echo $todaydate; ?>';
   table.draw();
});
$('.reset').click(function() {
	document.getElementById('min-date').value='';document.getElementById('max-date').value='';
   table.draw();
});
$('#my-table_filter').hide();
}//]]> 
</script>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12" style="margin:0px !important;">
       <div class="widget widget-table action-table">
            
             
               <div class="widget-content" style="min-height: 600px;">
    <div class="pull-right col-md-5">
    <div class="input-group input-daterange" style="padding:15px;"><a class="reset" >Reiniciar</a> | <a class="last1month" >El mes pasado</a> | <a class="last2month" >Últimos 2 meses</a> | <a class="last3month" >Últimos 3 meses</a>
     
    <input type="text" id="min-date" class="form-control date-range-filter span2" data-date-format="dd-mm-yyyy" placeholder="De:">
    
     
    <input type="text" id="max-date" class=" span2 form-control date-range-filter" data-date-format="dd-mm-yyyy" placeholder="A:">
    
    </div>
    </div>
              <table id="table" class="table table-striped table-bordered printaction">
                <thead>
                  <tr>
                    <th datahighlight="col1">Riesgo</th>
                     <th datahighlight="col2">Perito</th>
                    <th datahighlight="col3" style="display:none;"> Fecha de creación</th>
                    <th datahighlight="col4" class="removesorting"> Fecha apertura</th>
                    <th datahighlight="col5" style="display:none;"> Fecha de Inicio</th>
                    <th datahighlight="col6" class="removesorting"> Fecha Contacto </th>
                    <th datahighlight="col7" class="removesorting"> Fecha Vencimiento</th>
                    <th datahighlight="col8"> Estado actual</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task) 
                  <tr>
                    <td class="col1">{{$task->title}}</td>
		
            <td class="col2">
              @php 
                $agent = App\User::where('id', $task->assign_to)->first();
                echo $agent->fname;
              @endphp
            </td>
                <td class="col3" style="display:none;"> 
                  @php
                    $created_date=strtotime($task->created_at);
                    $created_date=date('Y-m-d ',$created_date);echo $created_date;
                  @endphp
                </td>
                <td class="dud2 col4"><span style="display:none;">{{$created_date}}</span>
                  @php
                    $created_date=strtotime($task->created_at);
                    $created_date=date('d-m-Y ',$created_date);echo $created_date;
                  @endphp
                </td>

                <td class="col5" style="display:none;"> 
                  {{$task->task_startdate}}
                </td>
                <td class="dud2 col6"><span style="display:none;">{{$task->task_startdate}}</span>
                  @php
                    if(isset($task->task_startdate))
                    {
                      $task_startdate=strtotime($task->task_startdate);
                      $task_startdate=date('d-m-Y ',$task_startdate);echo $task_startdate;
                    }
                    elseif(!isset($task->task_startdate) && $task->status=="nuevoexpeditene")
                    {
                        echo "No visitado";
                    }
                  @endphp
                </td>

         	<td class="dud2 col7"><span style="display:none;">{{$task->due_date}}</span>
           <?php $duedatevalue = explode("-",$task->due_date); echo $duedatevalue[2]."-".$duedatevalue[1]."-".$duedatevalue[0];?>
           </td>
                  <td  class="col8">
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

            </tr>
                 @endforeach
                 </tbody>
              </table>
            </div>
             
          </div>
		  
        </div>
         
      </div>
       
    </div></div>
   
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
td.highlight {
    background-color: #e8ece8 !important;
}
  </style>
  <script>
     $(function () {
      // Apply the plugin 
      $('#table').excelTableFilter();
    });
  </script>
@endsection