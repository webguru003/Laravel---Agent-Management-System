@extends('layouts.app')
@section('title', 'EDITAR')
@section('content')
<style type="text/css">
.led-red {
 margin:0px;
 margin-right:10px; 
 float: left;
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
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
</script>		<div class="main">

		<div class="main-inner">

		<div class="container">

		<div class="row">

		<div class="span12">      		

		<div class="widget ">

		<div class="widget-header">
		<i class="icon-user"></i>
		<h3> información sobre el expediente</h3>
		</div> 
		<div class="widget-content">

		<div class="tab-pane" id="formcontrols">
				<form id="edit-task" class="form-horizontal" method="POST" action="{{url("/tasks/$task->id")}}">
				{{ method_field('PUT') }}
				{{ csrf_field() }}
						<fieldset>

							<div class="control-group">											
							<label class="control-label" for="id">NÚMERO DE REFERENCIA </label>
							<div class="controls">{{$task->reference_number}}</div> <!-- /controls -->				
							</div> <!-- /control-group -->


							<div class="control-group">											
							<label class="control-label" for="title">RIESGO</label>
							<div class="controls">
							<input type="text" class="span6" id="title" name="title" value="{{$task->title}}">
                            <input type="hidden" class="span6" id="taskidd" name="taskidd" value="{{$task->id}}">
                            
                            
                            @if ($errors->has('title'))
                            <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
							</div> <!-- /controls -->				
							</div> <!-- /control-group -->

							<div class="control-group">											
							<label class="control-label" for="asegurado">ASEGURADO</label>
							<div class="controls">
							<input type="text" class="span6" id="asegurado" name="asegurado" value="{{$task->asegurado}}">
							@if ($errors->has('asegurado'))
							<span class="help-block">
							<strong>{{ $errors->first('asegurado') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->				
							</div> <!-- /control-group -->

							<div class="control-group">											
							<label class="control-label" for="username">N/REF</label>
							<div class="controls">
							<input type="text" class="span6" id="dia_id" name="dia_id" value="{{$task->dia_id}}">
							@if ($errors->has('dia_id'))
							<span class="help-block">
							<strong>{{ $errors->first('dia_id') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->				
							</div> <!-- /control-group -->

							<div class="control-group">											
							<label class="control-label" for="username">REF.ARAG</label>
							<div class="controls">
								@php
									$ref_select=substr($task->reference_number,0,2);
								@endphp
							<select class="span2" id="ref_select"  name="ref_select">
							<option value="BC" @php if($ref_select=="BC"){echo "selected";} @endphp>BC</option>
							<option value="MC" @php if($ref_select=="MC"){echo "selected";} @endphp>MC</option>
							<option value="LS" @php if($ref_select=="LS"){echo "selected";} @endphp>LS</option>
							</select>
								@php
									$reference_number=substr($task->reference_number,2);
								@endphp
							<input type="text" class="span4" id="reference_number" name="reference_number" value="{{$reference_number}}">
							@if ($errors->has('reference_number'))
							<span class="help-block">
							<strong>{{ $errors->first('reference_number') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->				
							</div> <!-- /control-group -->

							<div class="control-group">											
							<label class="control-label" for="tramitador">TRAMITADOR</label>
							<div class="controls">
							<input type="text" class="span6" id="tramitador" name="tramitador" value="{{$task->tramitador}}">
							@if ($errors->has('tramitador'))
							<span class="help-block">
							<strong>{{ $errors->first('tramitador') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->				
							</div> <!-- /control-group -->

							<div class="control-group">											
							<label class="control-label" for="phone_number">TELÉFONO</label>
							<div class="controls">
							<input type="text" class="span6" id="phone_number" name="phone_number" value="{{$task->phone_number}}">
							@if ($errors->has('phone_number'))
							<span class="help-block">
							<strong>{{ $errors->first('phone_number') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="control-group">											
							<label class="control-label" for="contact_person">CONTACTO</label>
							<div class="controls">
							<input type="text" class="span6" id="contact_person" name="contact_person" value="{{$task->contact_person}}">
							@if ($errors->has('contact_person'))
							<span class="help-block">
							<strong>{{ $errors->first('contact_person') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->			
							</div> <!-- /control-group -->


							<div class="control-group">											
							<label class="control-label" for="task_price">EXPEDIENTE PRECIO</label>
							<div class="controls">
							<input type="text" class="span3" id="task_price" name="task_price" value="{{$task->	task_price}}">
							@if ($errors->has('task_price'))
							<span class="help-block">
							<strong>{{ $errors->first('task_price') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->				
							</div>


							<div class="control-group" style="display:none;">											
							<label class="control-label" for="comapnyid">NOMBRE DE EMPRESA</label>
							<div class="controls">
							<select class="span4" id="comapnyid" name="comapnyid">
							@foreach($clients as $client)
							<option value="{{$client->id}}" @php if($task->clients_id==$client->id){echo "selected";} @endphp>
							{{ucfirst($client->companyname)}}</option>
							@endforeach
							</select>
							</div> <!-- /controls -->				
							</div> <!-- /control-group -->

							
							<div class="control-group" style="display: none;">											
							<label class="control-label">NOTIFICACIÓN DE CORREO ELECTRÓNICO</label>
							<div class="controls">
							<label class="checkbox inline">
							<input type="checkbox"  id="checkedbut" name="modified" value="1">
							Marque para enviar correo electrónico a notificar al perito
							</label>
							</div>		<!-- /controls -->		
							</div>
                            


<div class="control-group">											
							<span class="led-red"></span> <label class="control-label">MENSAJE POR PERITO</label>
							<div class="controls" style="margin-left: 180px;">
<?php 
foreach ($comments as $comment) 
{
	if($comment->userid == 'admin') 
	{ 
		$cu_name = 'administrador';
		$csss  =   'background-color: #cdfec9;padding: 15px;border-radius: 15px;margin-bottom: 5px;margin-left: 100px;'; 
	} 
	else 
	{ 
		 $cu_ageent = DB::select('select * from users where id = ?', [$comment->userid]);
		 foreach ($cu_ageent as $cu_ageents) {
			$cu_name = $cu_ageents->username;
		 }
		 $csss  = 'background-color: #eceeee;padding: 15px;border-radius: 15px;margin-bottom: 5px;margin-right: 100px;'; 
	   
	 }
    echo "<div style='".$csss."'><h3>".$cu_name."</h3>";
    echo "<p>".$comment->datetime."</p>";
    echo "<p>".$comment->comments."</p></div>";
} 
?>
							</div>		<!-- /controls -->		
							</div>                            
                            









							@if(isset($task->message))
							<div class="control-group">											
							<label class="control-label">MENSAJE POR PERITO</label>
							<div class="controls">
							<textarea class="span6 ckeditor" rows="6" id="message" name="message"> 
							</textarea>
							
							</div>		<!-- /controls -->		
							</div>
							@endif

							<div class="control-group" id="modificationsdiv" style="display: none;">								
							<label class="control-label" for="modification">MODIFICATIONS DETALLES</label>
							<div class="controls">
							<textarea type="text" class="span6 ckeditor" id="modification" name="modification" rows="6">{{$task->modification}}</textarea>
							@if ($errors->has('modification'))
							<span class="help-block">
							<strong>{{ $errors->first('modification') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->				
							</div>

							<div class="control-group">											
							<label class="control-label" for="assignto">ASIGNAR A</label>
							<div class="controls">
							<select class="span4" id="assignto" name="assignto">
							@foreach($agents as $agent)
							<option value="{{$agent->id}}" @php if($task->assign_to==$agent->id){echo "selected";} @endphp>
							{{ucfirst($agent->fname)}}</option>
							@endforeach
							</select>

							</div> <!-- /controls -->				
							</div>
							<div class="control-group">											
							<label class="control-label" for="duedate">FECHA DE VENCIMIENTO</label>
							<div class="controls">
           					<?php $duedatevalue = explode("-",$task->due_date); $date=$duedatevalue[2]."-".$duedatevalue[1]."-".$duedatevalue[0];?>
							<input type="text" class="span3 datepickert" id="duedate" name="duedate" value="{{$date}}">
                            @if ($errors->has('duedate'))
                            <span class="help-block">
                            <strong>{{ $errors->first('duedate') }}</strong>
                            </span>
                            @endif
							</div> <!-- /controls -->				
							</div>
							
							<div class="control-group">											
							<label class="control-label" for="details">DETALLES</label>
							<div class="controls">
							<textarea type="text" class="span6 ckeditor" id="details" name="details" rows="6">{{$task->details}}</textarea>
                            @if ($errors->has('details'))
                            <span class="help-block">
                            <strong>{{ $errors->first('details') }}</strong>
                            </span>
                            @endif
							</div> <!-- /controls -->				
							</div>
							

							<div class="control-group">											
							<label class="control-label" for="status">ESTADO</label>
							<div class="controls">
		<select class="span4" id="taskstatus" name="status" @php if($task->status=="facturada"){echo "readonly";} @endphp>
							
						@if($task->status !=="facturada")
							
							@if($task->status=="nuevoexpeditene")
								<option value="nuevoexpeditene" @php if($task->status=="nuevoexpeditene"){echo "selected";} @endphp>
								NUEVO EXPEDIENTE</option>
								<option value="enproceso" @php if($task->status=="enproceso"){echo "selected";} @endphp>
								EN PROCESO</option>
								@else
								<option value="enproceso" @php if($task->status=="enproceso"){echo "selected";} @endphp>
								EN PROCESO</option>
								<option value="incicencia" @php if($task->status=="incicencia"){echo "selected";} @endphp>
								INCICENCIA</option>
								<option value="visitada" @php if($task->status=="visitada"){echo "selected";} @endphp>
								VISITADA</option>
	                            <option value="enmienda" @php if($task->status=="enmienda"){echo "selected";} @endphp>
								ENMIENDA</option>
								<option value="noresponde" @php if($task->status=="noresponde"){echo "selected";} @endphp>
								NO RESPONDE</option>
								<option value="visitaconcertada" @php if($task->status=="visitaconcertada"){echo "selected";} @endphp>
								VISITA CONCERTADA</option>
							@endif
							
						@endif

							@if($task->status=="nuevoexpeditene")
								@else
								<option value="facturada" @php if($task->status=="facturada"){echo "selected";} @endphp>
								FACTURADA</option> 
							@endif
							</select>
							</div> <!-- /controls -->				
							</div>

							<div class="control-group taskinfo">											
							<label class="control-label" for="Kilómetros">KILÓMETROS</label>
							<div class="controls">
							<input type="text" class="span3" id="kilometers" name="kilometers" value="{{$task->	kilometers}}">
							@if ($errors->has('kilometers'))
							<span class="help-block">
							<strong>{{ $errors->first('kilometers') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->				
							</div>


							@php
							$invoice = App\Invoice::where('task_id','=', $task->id)->first();
							if(isset($invoice->invoice_number) && $invoice->date_created)
							{
								$invoice_number=$invoice->invoice_number;
								$completion_date_value=explode("-",$invoice->date_created);
								$completion_date=$completion_date_value[2]."-".$completion_date_value[1]."-".$completion_date_value[0];
							}
							else{$invoice_number="";$completion_date="";}
							@endphp

							<div class="control-group taskinfo">											
							<label class="control-label" for="completion_date">FECHA DE REALIZACIÓN
							</label>
							<div class="controls">
							<input type="text" class="span3 datepickert"  name="completion_date" value="{{$completion_date}}" id="completion_date">
							@if ($errors->has('completion_date'))
							<span class="help-block">
							<strong>{{ $errors->first('completion_date') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->				
							</div> <!-- /control-group -->


							<div class="control-group taskinfo">											
							<label class="control-label" for="invoice_number">NÚMERO DE FACTURA</label>
							<div class="controls">
							<input type="text" class="span3" id="invoice_number" name="invoice_number" value="{{$invoice_number}}">
							
							</div> <!-- /controls -->				
							</div>
							@if ($errors->has('invoice_number'))
							<span class="help-block">
							<strong>{{ $errors->first('invoice_number')}}</strong>
							</span>
							@endif



							<div class="control-group" style="display:none;">											
							<label class="control-label" for="numberofimages">NÚMERO DE IMÁGENEs</label>
							<div class="controls">
							<input type="text" class="span3" id="numberofimages" name="numberofimages" value="{{$task->	number_of_images}}">
							@if ($errors->has('numberofimages'))
							<span class="help-block">
							<strong>{{ $errors->first('numberofimages') }}</strong>
							</span>
							@endif
							</div> <!-- /controls -->				
							</div>

							<div class="form-actions">
							<button type="submit" class="btn btn-primary">GUARDAR</button> 
							</div> <!-- /form-actions -->
						</fieldset>
					</form>
		</div>
		</div> 

		</div> 

		</div> <!-- /span8 -->




		</div> 

		</div></div> 

		</div>
<script>
	$.validator.setDefaults({
		 errorLabelContainer: ".messageBox",
  		 wrapper: "span",
		submitHandler: function() 
		{
			form.submit();
		},
	});

	$().ready(function() {
		onkeyup: false

		$("#edit-task").validate({
			rules: 
			{
				title: "required",
				dia_id: "required",
				reference_number: "required",
				modifications:"required",
				phone_number: {
				required: true,
				maxlength: 30
				},
				contact_person: {
				required: true,
				maxlength: 50
				},
				duedate: {
				required: true,
				},
				kilometers: {
					required: true,
					number: true
				},
				task_price: {
					required: true,
					number: true
				},
				invoice_number: {
				required: true,
				},
				completion_date: {
				required: true,
				},
				asegurado: {
				maxlength: 255
				},
				tramitador: {
				maxlength: 255
				}

			},
			messages:
			 {
				title: "Por favor ingrese el título",
				modifications:"Por favor ingrese los detalles",
				phone_number: {
				required: "Por favor ingrese el teléfono",
				maxlength: "El teléfono del sitio no puede tener más de 30 caracteres",
				},
				contact_person: {
				required: "Por favor ingrese el contacto",
				maxlength: "El contacto del sitio no puede tener más de 50 caracteres",
				},
				dia_id: "Por favor escribe DIA-ID",
				reference_number: "Por favor escribe Ref.ac",
				duedate: {
				required: "Seleccione Fecha",
				},
				kilometers: {
					required: "Introduzca el kilómetro ",
					number: "Solo se permiten números",
				},
				task_price: {
					required: "Introduzca el expediente precio ",
					number: "Solo se permiten números",
				},
				invoice_number: {
					required: "Introduzca el, número de factura",
				},
				completion_date: {
					required: "seleccione la fecha de finalización",
				},
				asegurado: {
					maxlength: "Ssolo 255 caracteres permitidos",
				},
				tramitador: {
					maxlength: "solo 255 caracteres permitidos",
				}	
			},
			errorPlacement: function(error, element) {
			
			error.insertAfter(element);
			
			}
		});

	
	});
</script>

<script>     
	$(function() {
     $('.taskinfo').hide(); 
     if($('#taskstatus').val() == 'facturada') {
            $('.taskinfo').show(); 
        }
    $('#taskstatus').change(function(){
        if($('#taskstatus').val() == 'facturada') {
            $('.taskinfo').show(); 
        } else {
            $('.taskinfo').hide(); 
        } 
    });
});

</script><!-- /Calendar -->

@endsection