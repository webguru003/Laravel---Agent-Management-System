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
<style type="text/css">
	
tr.spaceUnder>td {
  padding-bottom: 15px;
}

</style>
</head>
<body class="invoicebody">
 <div class="ui button aligned center teal btn btn-info" id="create_pdf" style="display:none;">Create PDF</div>	
 <div class="main">
	<div class="main-inner">
<form class="ui form" >
	    <div class="container">

	      <div class="row">	      	
 <br>
<div class="span12">
	 <table width="700">
        <tr>
            <td>
            </td>
            <td>
            <h1 style="text-align:left; font-size:36px;">FACTURA</h1><br>
            </td>
        </tr>
       
        <tr>
    
            <td  width="50%">
			<h4><strong><u>CLIENTE</u></strong></h4>
			<span>
			ARAG SE<br>
			Carrer Roger de Flor 16<br>
			08018 Barcelona<br>
			W0049001A
			</span>
            </td>
            <td width="50%">
            @if($date[0])
			<span id="total">Fecha : {{$date[0]}}<br>DISSENY I ARQUITECTURA TALLER PERICIAL SL<br> Rda Europa, 60 5-2<br> 08800 Vilanova i la Geltrú<br> B467753561</br></br></span>
			@endif
            </td>
        </tr>

</table>
			</div>
            <div class="span12">
					 <table style="border:none;" width="700" class="invoice-tb">
 		      		        <tr>
 		      		          <td bgcolor="#eeeeee"><strong>Informe Riesgo</strong></td>
 		      		          <td bgcolor="#eeeeee">Cuenta Detalle</td>
	      		            </tr>
	      		            <tr>
	      		            <td></td>
	      		            <td></td>
	      		            </tr>
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
 		      		          <td width="50%"><strong>{{$taskdata->title}}</strong></td>
 		      		          <td width="50%"><strong>{{$total_agent_bill}} €</strong></td>
	      		            </tr>
							@php
							$total_agent_bill=0;
							@endphp
						@endfor
                        <tr>
 		      		          <td width="50%" bgcolor="#eeeeee"><strong>CANTIDAD TOTAL</strong></td>
 		      		          <td width="50%" bgcolor="#eeeeee"><strong>{{$overalltotal}} €</strong></td>
	      		            </tr>
 	      		          </table>
                          <br>
                         
<br>
 	      </div> 
	
	    </div></form></div> 
	    
</div>

	<script type="text/javascript" src="{{asset('js/pdf/html2canvas.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pdf/jspdf.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pdf/app.js')}}"></script>
 <script>
$( window ).load(function() {
$("#create_pdf").trigger('click'); 
 $(".form").hide();
});
window.setTimeout('self.close()', 8000);
</script>
</body>
</html>