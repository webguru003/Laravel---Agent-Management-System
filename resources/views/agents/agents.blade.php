@extends('layouts.app')
@section('title', '')
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
// Set up your table
table = $('#table').DataTable({
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

}
</script>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
         
       @if ($errors->any())
    <div class="alert alert-danger span6">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="span12" style="margin:0px !important;">
			<a href="{{url('/agents/create')}}"><button type="submit" class="btn btn-primary" style="float:right;">Añadir peritos</button></a><br>
<br>

		</div>
        <div class="span12" style="margin:0px !important;">
           
       <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Lista de peritos </h3>
            </div>
            <div class="widget-content" style="min-height: 600px;">
              <table id="table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th datahighlight="col1"> Nombre </th>
                    <th datahighlight="col2"> Email</th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($agents as $agent)
                  <tr>
                    <td class="col1"> <a href="{{url("/agents/reports/all")}}">{{$agent->username}}</a></td>
                    <td class="col2"> {{$agent->email}} </td>
                    <td class="td-actions"><a href="{{url("/agents/$agent->id/edit")}}" class="btn btn-small btn-success">EDITAR</a>
                    <form action="{{url("/agents/$agent->id")}}" method="POST" style="display:inline;">
                    {!! method_field('DELETE') !!}
                    {{ csrf_field() }}
                    <button  class="btn btn-danger btn-small confirmation">BORRAR</button>
                    </form>
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
 .highlight {background-color: #EEEEEE !important;}
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
     $(function () {
      // Apply the plugin 
      $('#table').excelTableFilter();
    });
  </script> 
@endsection