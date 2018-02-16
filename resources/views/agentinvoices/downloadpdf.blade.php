<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Tablero - DIA</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/pages/dashboard.css')}}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/pdf/jspdf.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pdf/app.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/pdf/autotable.js')}}"></script>
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

            <div class="span12" id="data">
					 <table class="table"  id="table" style="display: none;">
						<thead>
							<tr>
								<th >Informe Riesgo</th>
								<th > Fecha de Inicio</th>
								<th > Fecha de Final</th>
								<th >Cuenta Detalle</th>
							</tr>
						</thead>
						<tbody>
							@php
							$totalcount=count($task_id);
	      		            $overalltotal=0;
	      		            $total_agent_bill=0;
	      		            @endphp
							@for ($i = 0; $i < $totalcount ; $i++) 
								@php
									$taskdata = App\Task::where('id','=', $task_id[$i])->first();
									$invoice = App\Invoice::where('task_id','=', $taskdata->id)->first();
									if($taskdata->kilometers > $invoice->fixed_kilometers)
									{
										$requied_kilometers=$taskdata->kilometers-$invoice->fixed_kilometers;
									}
									else
									{
										$requied_kilometers=0;
									}
									$total_kilometer_price=($requied_kilometers)*($invoice->kiometers_price);
		         					$total_agent_bill=($taskdata->task_price+$total_kilometer_price)/2;
		         					$overalltotal=$overalltotal+$total_agent_bill;
		         				@endphp
	 		      		        <tr class="spaceUnder">
	 		      		          <td><strong>{{$taskdata->title}}</strong></td>
	 		      		          <td>
	 		      		          	@php
	 		      		          	if($taskdata->task_startdate)
	 		      		          	{
										$start_date = explode("-",$taskdata->task_startdate);
										echo $start_date[2]."-".$start_date[1]."-".$start_date[0];
									}
									@endphp

	 		      		          </td>
	 		      		          <td>
									@php
									if($taskdata->completion_date)
									{
										$completion_date = explode("-",$taskdata->completion_date); echo $completion_date[2]."-".$completion_date[1]."-".$completion_date[0];
									}
									@endphp
	 		      		          </td>
	 		      		          <td>{{$total_agent_bill}} €</td>
		      		            </tr>
	                       		@php
		      		            $total_agent_bill=0;
		      		            @endphp
                       		@endfor
                        <tr>
 		      		          
 		      		          <td bgcolor="#eeeeee"><strong>CANTIDAD TOTAL<strong></td>
 		      		          <td bgcolor="#eeeeee">-</td>
 		      		          <td bgcolor="#eeeeee">-</td>
 		      		          <td bgcolor="#eeeeee"><strong>{{$overalltotal}} €</strong></td>
	      		            </tr>
 	      		    </tbody>
 	      		    </table>
  
 	      </div> 
	
	    </div></div> 
	    
</div>
<script type="text/javascript">
$(document).ready(function()
{
	/*var d = new Date();
	var strDate = d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear();
	$("#total").html("Fecha  :"+strDate+"<br>DISSENY I ARQUITECTURA TALLER PERICIAL SL<br> Rda Europa, 60 5-2<br> 08800 Vilanova i la Geltrú<br> B467753561<br><br>");*/
downloadPdf();

});

function downloadPdf() {
var d = new Date();
	var datecre = d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear();
var pdfsize = 'a4';
var doc = new jsPDF('p', 'pt', pdfsize);

   doc.setFontSize(18);
    doc.setTextColor(40);
    doc.setFontStyle('normal');
  doc.text("Factura", 40, 50);
  doc.text("Fecha:"+datecre, 400, 50);
  var res = doc.autoTableHtmlToJson(document.getElementById("table"));
  doc.autoTable(res.columns, res.data, {margin: {top: 70}});

  var header = function(data) {
    doc.setFontSize(18);
    doc.setTextColor(40);
    doc.setFontStyle('normal');
    //doc.addImage(headerImgData, 'JPEG', data.settings.margin.left, 20, 50, 50);
  };

  var options = {
    beforePageContent: header,
    margin: {
      top: 80
    },
    startY: doc.autoTableEndPosY() + 20
  };


  doc.save("Factura.pdf");
    }
</script>
</body>