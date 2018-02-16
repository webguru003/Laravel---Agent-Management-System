<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252"/>
        <meta name=ProgId content=Excel.Sheet/>
        <meta name=Generator content="Microsoft Excel 11"/>
<meta charset="utf-8">

<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/pages/dashboard.css')}}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
exportExcel();
});
function exportExcel(){
 var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'Informs_listada_' + Math.random() + '.xls';
    a.click();	
}
</script>
<style type="text/css">
	
tr.spaceUnder>td {
  padding-bottom: 15px;
}

</style>
</head>
<body class="invoicebody">
 <div class="main" >
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">	      	
	

 <br>


            <div class="span12" id="table_wrapper">
  <br />
  <br />
  <div >
    <table border="1" cellspacing="0" bordercolor="#222" id="list" style="display: none;">
      <tbody>
        <tr class="header">
          <th>N/REF</th>
          <th>REF.ARAG</th>
          <th>RIESGO</th>
          <th>PERITO</th>
          <th>VENCIMIENTO</th>
          <th>FETCHA VISITA</th>
          <th>ESTADO</th>
        </tr>
		@php
		$totalcount=count($task_id);
		@endphp
    @for ($i = 0; $i < $totalcount ; $i++) 
     @php
     $taskdata = App\Task::where('id','=', $task_id[$i])->first();
     $agent = App\User::where('id', $taskdata->assign_to)->first();
     $duedatevalue = explode("-",$taskdata->due_date);
      $due_date= $duedatevalue[2]."-".$duedatevalue[1]."-".$duedatevalue[0];
		 if(isset($taskdata->meeting_date)){
           
             $meeting_date = explode("-",$taskdata->meeting_date);  
             $meeting_date=$meeting_date[2]."-".$meeting_date[1]."-".$meeting_date[0];
            }
            else{
            		$meeting_date="";
        		}
     @endphp  
        <tr>
          <td>{{$taskdata->dia_id}}</td>
          <td>{{$taskdata->reference_number}}</td>
          <td>{{$taskdata->title}}</td> 
          <td>{{ucfirst($agent->fname)}}</td>
          <td>{{$due_date}}</td>
          <td>
          <span>{{$meeting_date}}</span><br>
          <span>{{$taskdata->meeting_time}}</span>
          </td>
		<td>{{$taskdata->status}}</td>
        </tr>
     @endfor  
      </tbody>
    </table>
  </div>
 	      </div> 
	
	    </div></div> 
	    
</div>
<script type="text/javascript">

</script>
</body>