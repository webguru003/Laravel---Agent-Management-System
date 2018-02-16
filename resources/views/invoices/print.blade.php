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
<style type="text/css">
	
tr.spaceUnder>td {
  padding-bottom: 15px;
}
tr.spaceTop>td {
  padding-top: 15px;
}

table, th, td {
   border: 1px solid black;

}

hr.style-eight {
    overflow: visible;
    padding: 0;
    border: none;
    border-top: medium double blue;
    color: #333;
    text-align: center;
}
hr.style-eight:after {
    content: "FACTURA";
    display: inline-block;
    position: relative;
    top: -0.7em;
    font-size: 2em;
    padding: 0 0.25em;
    background: white;
}
fieldset {
	border: 1px solid black;
	border-radius: 25px;
	padding-left: 30px;
	padding-bottom:10px; 
	margin-bottom: 20px;
	margin-left: 10px;
}
legend{
width: auto;
border-bottom:none;
padding-left: 5px;
padding-right: 5px;
}
.bordernone{
	border: none;
}
</style>
</head>
<body class="invoicebody" style="margin-top: 50px;">
 <div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">	      	
	
    @php
 $task = App\Task::where('id', $invoice->task_id)->first();
 $client = App\Client::find($task->clients_id);
	if($task->kilometers > $invoice->fixed_kilometers)
			{
				$requied_kilometers=$task->kilometers-$invoice->fixed_kilometers;
			}
			else
			{
				$requied_kilometers=0;
			}
 $total_kilometer_price=($requied_kilometers)*($invoice->kiometers_price);
 $total_price_withoutvat=$task->task_price+$total_kilometer_price;
 $vat=(($invoice->vat)/100)*($total_price_withoutvat);
 $total=$task->task_price+$total_kilometer_price+$vat;
 $ref_select=substr($task->reference_number,0,2);
 @endphp
    
     	<div class="span12"><!-- row container -->
		     	<table style="border:none !important;">
				<tr>
				<td class="bordernone">
				<img src="{{ url('img/LOGODA.jpg') }}" width="400" style="margin-bottom: 18px;margin-left: 60px;"> 
				</td>
				</tr>
				<tr>
		     	<tr>
			     	<td class="bordernone">	
				     	<div class="span8" style="margin: 0px;margin-left: 60px;">
							<h1>DISSENY I ARQUITECTURA</h1>               
							<h3>TALLER PERICIAL, S.L.</h3>
							Ronda Europa, nº60, 5º 2ª   (Edifici  Eurocentre)<br>
							08800 VILANOVA I LA GELTRU (BARCELONA)<br>
							N.I.F.: B66902933

				     	</div>
			     	</td>

				     <td class="bordernone">	
				     	<div class="span4">
					     	<h3>
					     	Nº Factura: {{$invoice->invoice_number }}<br>
					     <?php $datecreated = explode("-",$invoice->date_created);  $date_created=$datecreated[2]."-".$datecreated[1]."-".$datecreated[0];?>
					     	Fecha Factura: {{$date_created}}
					     	</h3>	
				     	</div>
			     	</td>
		     	</tr>
     		</table>
     	</div><!-- span12 end -->
           
          	<div class="span12">
	          	<table>
	          	<tr>
	          	<hr class="style-eight"></hr>
	          	</tr>
	          	</table>	
          	</div>

<div class="span12">
			<table width="100%"  style="border:none !important;">
			<tr>
						<td class="bordernone">
			          	
		      	 		<fieldset>
				      	<legend><strong>Cliente</strong></legend>
		                    @if($ref_select=="BC" || $ref_select=="MC")
			                    <span>
									Nombre:ARAG S.E.<br> 	 	 	 	 
									Dirección:	Roger de Flor, 16<br>
									Ciudad:	Barcelona-CP 08018<br>
									N.I.F. 	W0049001A
								</span>
								@elseif($ref_select=="LS")
									<span>
										Nombre:	ARAG L.S.<br> 	 	 	 	 
										Dirección:	Calle Nuñez y Balboa, 120 <br>
										Ciudad:	28006 - Madrid<br>
										N.I.F. 	W0049001A
									</span>
							@endif

					</fieldset>

				
				</td>
					<td class="bordernone">
			      	
			      	<fieldset>
			      		<legend><strong>Informe</strong></legend>
			 			<span>
							Codigo / Expediente:	{{$task->reference_number}}<br>
							Tipologia:	Informe<br>
							Dirección:<br>	 
							Población:	 
							</span>
					</fieldset>
					
					</td>
			</tr>
			</table>
	</div><!-- span12 end -->
            <div class="span12" >
					 <table  width="100%" class="invoice-tb" class="table table-bordered" border="1">
 		      		        <thead>
 		      		        <th>Cantidad</th>
 		      		        <th>Concepto</th>
 		      		        <th width="15%">Precio Unitario</th>
 		      		        <th width="15%">TOTAL (euros)</th>	

 		      		        </thead>

 		      		 		<tbody>

	      		             <tr class="spaceUnder spaceTop">
 		      		          <td><strong></strong></td>
								<td>
								Honorarios profesionales para la redacción de informe pericial:<br>

								- Referencia del Siniestro:		{{$task->reference_number}}	<br>	 
								- Asegurado: ALEJANDRO BLAZQUEZ NAVARRO<br>
								- Dirección: Ps. Maragall, 212  6º 1ª (Barcelona)<br>
								- Tramitador/a: Carmen Masero Pastor
								</td>
 		      		          <td ></td>
 		      		          <td >{{$task->task_price}} €</td>
	      		            </tr>

 		      		        <tr class="spaceUnder">
 		      		          <td><strong>{{$task->kilometers}}</strong></td>
 		      		          <td >Kilometraje</td>
 		      		          <td >{{$invoice->kiometers_price}}</td>
 		      		          <td >{{$total_kilometer_price}} €</td>
	      		            </tr>

	      		          
 		      		        <tr>
 		      		        <td colspan="2" class="bordernone">
							</td>
							<td >Subtotal</td>
 		      		         <td >{{$task->task_price+$total_kilometer_price}} €</td>
 		      		        
	      		            </tr>

	      		            <tr class="spaceUnder">
 		      		          <td class="bordernone" colspan="2">
 		      		          		
 		      		          </td>
 		      		         
 		      		          <td>Importe  {{$invoice->vat}}% I.V.A</td>
 		      		          <td >{{$vat}} €</td>
	      		            </tr>

	      		             <tr class="spaceUnder">
 		      		          <td class="bordernone"></td>
 		      		          <td class="bordernone"></td>
 		      		           <td ><strong>TOTAL (EUROS)</strong></td>
 		      		          <td >{{$total}} €</td>
	      		            </tr>
	      		            <tr>
	      		            	<td colspan="2" class="bordernone"><fieldset>
								<legend>Forma Pago</legend>
								Transferencia IBAN	 ES47 0182 9754 5202 0048 8142<br>
								</fieldset></td>
	      		            </tr>
 		      		        
                       		</tbody>
 	      		          </table>


	   <div class="12" style="text-align: center;margin-top: 50px;">
	   	<h4>
	   	Les dades de carácter personal que ens han facilitat s’inclouran als fitxers interns de Disseny i Arquitectura i seran<br> tractades de forma confidencial d’acord amb el que disposa la llei orgànica 15/1999  de Protecció de Dades de Carácter<br> Personal, i no seran cedides a altres entitats. 
	   	</h4>
	   </div>   	 
<hr style="border-top: medium double blue;overflow: visible;"></hr>	      	
	      	   	
 	      </div> 
	
	    </div></div> 
	    
</div></div>
</body>
</html>
 

 
    
    
     