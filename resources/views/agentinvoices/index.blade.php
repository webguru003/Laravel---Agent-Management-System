@extends('layouts.app')
@section('content')
<link href="{{asset('datatable/excel-bootstrap-table-filter-style.css')}}" rel="stylesheet" type="text/css" />
 <script src="{{ asset('datatable/datatables.min.js') }}"></script>
<script src="{{ asset('datatable/excel-bootstrap-table-filter-bundle.js') }}"></script>
<script src="{{ asset('datatable/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('datatable/moment.min.js') }}"></script>
 <script type='text/javascript'>//<![CDATA[
 $.fn.dataTable.Api.register( 'column().data().sum()', function () {
    return this.reduce( function (a, b) {
        var x = parseFloat( a ) || 0;
        var y = parseFloat( b ) || 0;
        return x + y;
    } );
} );

window.onload=function(){
// Bootstrap datepicker

var table = $('#table').DataTable({
  paging: true,
  info: true,
  pageLength: 25,
  ordering: false,

});
document.getElementById("dataforexport").value ='';
var tabddata = table.column(1 ).data();

var totalrecordsl = table.column(1 ).data().length;
for(ii=0;ii<totalrecordsl;ii++)
{

document.getElementById("dataforexport").value = document.getElementById("dataforexport").value  + tabddata[ii] +",";


}

document.getElementById("totalamountofagent").value=table.column(5 ).data().sum();
var num = document.getElementById("totalamountofagent").value;
document.getElementById("totalamountofagent").value = num;


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
  function(invoices, data, dataIndex) {

     var min0 = $('#min-date').val();
     var max0 = $('#max-date').val();
   
    var min1 = min0.split("-");
      var max1 = max0.split("-");

       var min2 = min1[2]+"-"+min1[1]+"-"+min1[0];
      var max2 = max1[2]+"-"+max1[1]+"-"+max1[0];

 if(min0 == '' && max0 =='') {min2='';max2=''; } 
      var min = min2;
    var max = max2;

  
    var createdAt = data[3]; // Our date column in the table

    if (
      (min == "" || max == "") ||
      (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
    ) {
      return true;
    }
    return false;
  }
);


$('.dropdown-filter-menu-item').change(function() {
changeValues();
        
});

$('#min-date').change(function() {
    table.draw();
});
$('#max-date').change(function() {
    table.draw();

document.getElementById("dataforexport").value ='';

var tabddata = table.column(1 ).data();

var totalrecordsl = table.column(1 ).data().length;

for(ii=0;ii<totalrecordsl;ii++)
{

document.getElementById("dataforexport").value = document.getElementById("dataforexport").value  + tabddata[ii] +",";


}

  document.getElementById("totalamountofagent").value=table.column(5 ).data().sum();
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
document.getElementById("dataforexport").value ='';
 var tabddata = table.column(1 ).data();

var totalrecordsl = table.column(1 ).data().length;

for(ii=0;ii<totalrecordsl;ii++)
{

document.getElementById("dataforexport").value = document.getElementById("dataforexport").value  + tabddata[ii] +",";


}  document.getElementById("totalamountofagent").value=table.column(5 ).data().sum();
});
$('.last2month').click(function() {
  document.getElementById('min-date').value='<?php echo $lasttwomonth; ?>';
  document.getElementById('max-date').value='<?php echo $todaydate; ?>';
   table.draw();
document.getElementById("dataforexport").value ='';
var tabddata = table.column(1 ).data();

var totalrecordsl = table.column(1 ).data().length;

for(ii=0;ii<totalrecordsl;ii++)
{

document.getElementById("dataforexport").value = document.getElementById("dataforexport").value  + tabddata[ii] +",";


}   document.getElementById("totalamountofagent").value=table.column(5 ).data().sum();
});
$('.last3month').click(function() {
  document.getElementById('min-date').value='<?php echo $lastthreemonth; ?>';
  document.getElementById('max-date').value='<?php echo $todaydate; ?>';
   table.draw();
document.getElementById("dataforexport").value ='';
var tabddata = table.column(1 ).data();

var totalrecordsl = table.column(1 ).data().length;

for(ii=0;ii<totalrecordsl;ii++)
{

document.getElementById("dataforexport").value = document.getElementById("dataforexport").value  + tabddata[ii] +",";


}   
document.getElementById("totalamountofagent").value=table.column(5 ).data().sum();
});
$('.reset').click(function() {
  document.getElementById('min-date').value='';document.getElementById('max-date').value='';
   table.draw();
document.getElementById("dataforexport").value ='';
var tabddata = table.column(1 ).data();

var totalrecordsl = table.column(1 ).data().length;

for(ii=0;ii<totalrecordsl;ii++)
{

document.getElementById("dataforexport").value = document.getElementById("dataforexport").value  + tabddata[ii] +",";


}   document.getElementById("totalamountofagent").value=table.column(5 ).data().sum();
});

$('.input-daterange input').each(function() {
  $(this).datepicker('clearDates');
document.getElementById("dataforexport").value ='';
var tabddata = table.column(1 ).data();

var totalrecordsl = table.column(1 ).data().length;

for(ii=0;ii<totalrecordsl;ii++)
{

document.getElementById("dataforexport").value = document.getElementById("dataforexport").value  + tabddata[ii] +",";


}
  document.getElementById("totalamountofagent").value=table.column(5 ).data().sum();
});

$('#my-table_filter').hide();
}//]]> 


function changeValues(){
   document.getElementById("totalamountofagent").value = 0;
      var table = document.getElementsByTagName("table");
      console.log(table);
      var cells = table[0].getElementsByTagName("tr");
      document.getElementById("dataforexport").value = '';
      for (var i = 1; i <= cells.length; i++) {
      //console.log(cells[i].style.display);
      
      var ceeell = cells[i].style.display;
      if(ceeell == "none")
        {}
        else
        {
          document.getElementById("totalamountofagent").value = parseFloat(document.getElementById("totalamountofagent").value) + parseFloat(cells[i].getElementsByTagName('td')[5].innerHTML);

document.getElementById("dataforexport").value = document.getElementById("dataforexport").value  + cells[i].getElementsByTagName('td')[1].innerHTML +",";

        }
      }
     };

</script>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12" style="margin:0px !important;">
       <div class="widget widget-table action-table">
            
             
               <div class="widget-content" style="min-height: 600px;">
    <div class="pull-right col-md-5">
<div id="demo"></div>    <div class="input-group input-daterange" style="padding:15px;"><a class="reset" >Reiniciar</a> | <a class="last1month" >El mes pasado</a> | <a class="last2month" >Últimos 2 meses</a> | <a class="last3month" >Últimos 3 meses</a>
     
    <input type="text" id="min-date" class="form-control date-range-filter span2" data-date-format="dd-mm-yyyy" placeholder="De:">
    
     
    <input type="text" id="max-date" class=" span2 form-control date-range-filter" data-date-format="dd-mm-yyyy" placeholder="A:">
    
    </div>
    </div>
              <table id="table" class="table table-striped table-bordered printaction">
                <thead>
                  <tr>
                     <th datahighlight="col1">Perito</th>
                     <th datahighlight="col2">N/REF</th>
                    <th datahighlight="col3">riesgo</th>
                    <th datahighlight="col4" class="removesorting" style="display: none;"> Fecha de Finalizado</th>
                    <th datahighlight="col5" class="removesorting"> FECHA FIN</th>
                    <th datahighlight="col6" > IMPORTE</th>
                    </tr>
                </thead>
                <tbody>
                @php
                  $tasks = App\Task::where([
                  ['status','=', "facturada"]
                  ])->orderBy('assign_to', 'desc')->get();
                @endphp
            @if(count($tasks) > 0)
                    @foreach($tasks as $task) 
                          <tr>
                        <td class="col1">
                          @php 
                            $invoice = App\Invoice::where('task_id','=', $task->id)->first();
                            $agent = App\User::where('id', $task->assign_to)->first();
                            echo $agent->fname;
                          @endphp
                        </td>
                        <td class="col2">{{$task->dia_id}}</td>
                              <td class="col3">{{$task->title}}</td>
                          
                            <td class="col4" style="display:none;"> 
                            {{$task->completion_date}}
                          </td>
                          <td  class="dud2 col5"><span style="display: none;">{{$task->completion_date}}</span>
                          @php
                          $completion_date = explode("-",$task->completion_date); echo $completion_date[2]."-".$completion_date[1]."-".$completion_date[0];
                          @endphp
                          </td>
                            <td  class="col6">@php
                            if($task->kilometers > $invoice->fixed_kilometers)
                            {
                                $requied_kilometers=$task->kilometers-$invoice->fixed_kilometers;
                            }
                            else
                            {
                                $requied_kilometers=0;
                            }
                          $total_kilometer_price=($requied_kilometers)*($invoice->kiometers_price);
                          $task_total_amount=($task->task_price+$total_kilometer_price)/2;
                          echo $task_total_amount;
                            @endphp</td>
                         
                        </tr>
                  
                @endforeach
            @endif
                 </tbody>
              </table>
                  <form action="{{url("/invoices/print/agent")}}" method="post" id="dataid_form">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" id="dataforexport" name ="dia_ids" value="" style="width: 600px;">
                </form>
        <div class="buttons" style="text-align:right;position: relative;bottom: 50px;">
          <a id="sendinvoice"  class="btn  btn-small sendinvoice" style="display: none;">enviar a perito</a>&nbsp;&nbsp;
          <a id="print"><img src="{{url('img/print.png')}}" width="35" ></a>&nbsp;&nbsp;
          <a id="pdfdownload"  class="btn  btn-small btn-info" >DESCARGAR</a>&nbsp;&nbsp;
          
        </div>

<h1 style="text-align:center;position: relative; bottom: 22px;">Total IMPORTE : <input type="text" id="totalamountofagent" value="0" readonly="readonly" style="border: 0px solid; background:none;-webkit-box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.075);
-moz-box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.075);
box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.075);
-webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
-moz-transition: border linear 0.2s, box-shadow linear 0.2s;
-ms-transition: border linear 0.2s, box-shadow linear 0.2s;
-o-transition: border linear 0.2s, box-shadow linear 0.2s;
transition: border linear 0.2s, box-shadow linear 0.2s;font-size: 24px;"  >
  </h1>

            </div>
             
          </div>
      
        </div>
         
      </div>
       
    </div></div>
   
</div><div id="display"></div>
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

  <script type="text/javascript">
     $(function () {
      // Apply the plugin 
      $('#table').excelTableFilter();
    });

$("#print").click(function()
{
  $( "#dataid_form" ).submit();
});

$("#sendinvoice").click(function()
{
  event.preventDefault();
  var url ="<?php echo url('/invoices/sendinvoice/agent'); ?>";
sendData(url);
});

$("#pdfdownload").click(function()
{
  event.preventDefault();
  var url ="<?php echo url('/agentinvoice/pdf/agent/download'); ?>";
  $('#dataid_form').attr('action', url);
  $( "#dataid_form" ).submit();
});


function sendData(url)
{

  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
var form = $('#dataid_form')[0];
var formData = new FormData(form);
  var url = url;
  $.ajax({
    type: "POST",
    url: url,
    data:formData,
    contentType: false,
    processData: false,
    success: function(data)
    {         
     alert(data)
    },

    error: function(data)
    {
     $("#display").html(data.responseText);
    }

  });

}

</script>



@endsection