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
body {
    color: #000;
}    
tr.spaceUnder>td {
  padding-bottom: 10px;
}
tr.spaceTop>td {
  padding-top: 10px;
}
table, th, td {
   border: 1px solid black;

}

hr.style-eight {
  margin-top:0px;  
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
    font-size: 1.6em;
    /*padding: 0 0.25em;*/
    background: white;
}
fieldset {
  border: 1px solid black;
  border-radius: 25px;
  padding-left: 30px;
  padding-bottom:4px; 
  margin-bottom: 20px;
  margin-left: 10px;
}
legend{
width: auto;
border-bottom:none;
padding-left: 5px;
padding-right: 5px;
margin-bottom:0px;
}
.bordernone{
  border: none !important;
}
</style>
</head>
<body class="invoicebody">
 <div class="main">
 <div class="ui button aligned center teal btn btn-info" id="create_pdf" style="display:none;">Create PDF</div>
	<form class="ui form">
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
    
      <div class=""><!-- row container -->
          <table width="700" style="border:none !important;">
			<tr>
			<td class="bordernone">
			<img src="{{ url('img/LOGODA.jpg') }}" width="300" style="margin-bottom: 7px;margin-left: 60px;"> 
			</td>
			</tr>
          <tr>
            <td class="bordernone"> 
              <div class="" style="margin: 0px;margin-left: 60px;">
              <h2>DISSENY I ARQUITECTURA</h2>               
              <h3>TALLER PERICIAL, S.L.</h3>
              Ronda Europa, nº60, 5º 2ª   (Edifici  Eurocentre)<br>
              08800 VILANOVA I LA GELTRU (BARCELONA)<br>
              N.I.F.: B66902933

              </div>
            </td>

             <td class="bordernone">  
              <div class="">
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
           
            <div class="">
              <table width="700" style="border:none !important;">
              <tr>
              <hr class="style-eight"></hr>
              </tr>
              </table>  
            </div>

<div class="span12">
      <table width="700"  style="border:none !important;">
      <tr>
            <td class="bordernone">
                  
                <fieldset>
                <legend><strong>Cliente</strong></legend>
                        @if($ref_select=="BC" || $ref_select=="MC")
                          <span>
                  Nombre:ARAG S.E.<br>         
                  Dirección:  Roger de Flor, 16<br>
                  Ciudad: Barcelona-CP 08018<br>
                  N.I.F.  W0049001A
                </span>
                @elseif($ref_select=="LS")
                  <span>
                    Nombre: ARAG L.S.<br>          
                    Dirección:  Calle Nuñez y Balboa, 120 <br>
                    Ciudad: 28006 - Madrid<br>
                    N.I.F.  W0049001A
                  </span>
              @endif

          </fieldset>

        
        </td>
          <td class="bordernone">
              
              <fieldset>
                <legend><strong>Informe</strong></legend>
            <span>
              Codigo / Expediente:  {{$task->reference_number}}<br>
              Tipologia:  Informe<br>
              Dirección:<br>   
              Población:   
              </span>
          </fieldset>
          
          </td>
      </tr>
      </table>
  </div><!-- span12 end -->
            <div class="span12" >
           <table  width="700" class="invoice-tb" class="table table-bordered" border="1">
                      <thead>
                      <th style="border-bottom:0px solid #000000;border-right:0px solid #000000;">Cantidad</th>
                      <th style="border-bottom:0px solid #000000;border-right:0px solid #000000;">Concepto</th>
                      <th width="15%" style="border-bottom:0px solid #000000;border-right:0px solid #000000;">Precio Unitario</th>
                      <th width="15%" style="border-bottom:0px solid #000000;">TOTAL (euros)</th>  

                      </thead>

                  <tbody>

                         <tr class="spaceUnder spaceTop">
                        <td style="border-bottom:0px solid #000000;border-right:0px solid #000000;"><strong></strong></td>
                <td style="border-bottom:0px solid #000000;border-right:0px solid #000000;">
                Honorarios profesionales para la redacción de informe pericial:<br>

                - Referencia del Siniestro:   {{$task->reference_number}} <br>   
                - Asegurado: ALEJANDRO BLAZQUEZ NAVARRO<br>
                - Dirección: Ps. Maragall, 212  6º 1ª (Barcelona)<br>
                - Tramitador/a: Carmen Masero Pastor
                </td>
                        <td  style="border-bottom:0px solid #000000;border-right:0px solid #000000;"></td>
                        <td  style="border-bottom:0px solid #000000;">{{$task->task_price}} €</td>
                        </tr>

                      <tr class="spaceUnder">
                        <td style="border-right:0px solid #000000;"><strong>{{$task->kilometers}}</strong></td>
                        <td  style="border-right:0px solid #000000;">Kilometraje</td>
                        <td  style="border-bottom:0px solid #000000;border-right:0px solid #000000;">{{$invoice->kiometers_price}}</td>
                        <td  style="border-bottom:0px solid #000000;">{{$total_kilometer_price}} €</td>
                        </tr>

                      
                      <tr>
                      <td colspan="2" class="bordernone">
              </td>
              <td   style="border-bottom:0px solid #000000;border-right:0px solid #000000;">Subtotal</td>
                       <td   style="border-bottom:0px solid #000000;">{{$task->task_price+$total_kilometer_price}} €</td>
                      
                        </tr>

                        <tr class="spaceUnder">
                        <td class="bordernone" colspan="2">
                            
                        </td>
                       
                        <td  style="border-bottom:0px solid #000000;border-right:0px solid #000000;">Importe  {{$invoice->vat}}% I.V.A</td>
                        <td   style="border-bottom:0px solid #000000;">{{$vat}} €</td>
                        </tr>

                         <tr class="spaceUnder">
                        <td class="bordernone"></td>
                        <td class="bordernone"></td>
                         <td   style="border-right:0px solid #000000;"><strong>TOTAL (EUROS)</strong></td>
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


    <table width="700" style="border:none !important;margin-top: 10px;">
    <tr>
        <td class="bordernone">
          <h4 style="font-size: 12px;text-align: justify;">
          Les dades de carácter personal que ens han facilitat s’inclouran als fitxers interns de Disseny i Arquitectura i seran tractades de forma confidencial d’acord amb el que disposa la llei orgànica 15/1999  de Protecció de Dades de CarácterPersonal, i no seran cedides a altres entitats. 
          </h4>
        </td>
      </tr>
     </table>    
<hr style="border-top: medium double blue;overflow: visible;"></hr>         
              
        </div> 
</form>
	<script type="text/javascript" src="{{asset('js/pdf/html2canvas.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pdf/jspdf.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pdf/app.js')}}"></script>
 <script>
$( window ).load(function() {
 $("#create_pdf").trigger('click'); 
});
</script>
</body>
</html>
 

 
    
    
     