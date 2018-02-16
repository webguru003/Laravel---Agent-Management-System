@extends('layouts.app')
@section('title', 'Añadir')
@section('content')
	@php
		$todaydate = date('Y-m-d');;
		$days_added = 14;
		$d = new DateTime( $todaydate );
		$t = $d->getTimestamp();
		// loop for X days
		    for($i=0; $i<$days_added; $i++)
		    {

		        // add 1 day to timestamp
		        $addDay = 86400;

		        // get what day it is next day
		        $nextDay = date('w', ($t+$addDay));

		        // if it's Saturday or Sunday get $i-1
		        if($nextDay == 0 || $nextDay == 6) {
		            $i--;
		        }

		        // modify timestamp, add 1 day
		        $t = $t+$addDay;
		    }
		 $d->setTimestamp($t);
		$date_afte14_days=$d->format( 'd-m-Y' );
	@endphp
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	
	      	<div class="span12">      		
	      		
	      		<div class="widget ">
	      			
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Nuevo Informes</h3>
	  				</div> 
					
					<div class="widget-content">

			<div class="tab-pane" id="formcontrols">
			<form id="add-task" class="form-horizontal" method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<fieldset>

			<div class="control-group">											
			<label class="control-label" for="username">RIESGO</label>
			<div class="controls">
			<input type="text" class="span6" id="title" name="title" value="{{old('title')}}">
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
			<input type="text" class="span6" id="asegurado" name="asegurado" value="{{old('asegurado')}}">
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
			<input type="text" class="span6" id="dia_id" name="dia_id" value="{{old('dia_id')}}">
			@if ($errors->has('dia_id'))
			<span class="help-block">
			<strong>{{ $errors->first('dia_id') }}</strong>
			</span>
			@endif
			</div> <!-- /controls -->				
			</div> <!-- /control-group -->


			<div class="control-group">											
			<label class="control-label" for="reference_number">REF.ARAG</label>
			<div class="controls">
				<select class="span2" id="ref_select"  name="ref_select">
				<option value="BC">BC</option>
				<option value="MC">MC</option>
				<option value="LS">LS</option>
				</select>
			<input type="text" class="span4" id="reference_number" name="reference_number" value="{{old('reference_number')}}">
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
			<input type="text" class="span6" id="tramitador" name="tramitador" value="{{old('tramitador')}}">
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
			<input type="text" class="span6" id="phone_number" name="phone_number" value="{{old('phone_number')}}">
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
			<input type="text" class="span6" id="contact_person" name="contact_person" value="{{old('contact_person')}}">
			@if ($errors->has('contact_person'))
			<span class="help-block">
			<strong>{{ $errors->first('contact_person') }}</strong>
			</span>
			@endif
			</div> <!-- /controls -->			
			</div> <!-- /control-group -->

			

			<div class="control-group" style="display:none;">											
			<label class="control-label" for="companyname">NOMBRE DE EMPRESA
			</label>
			<div class="controls">
			<select class="span4" id="comapnyid"  name="comapnyid">
			@foreach($clients as $client)
			<option value="{{$client->id}}">{{ucfirst($client->companyname)}}</option>
			@endforeach
			</select>
			</div> <!-- /controls -->				
			</div> <!-- /control-group -->

			<div class="control-group">											
			<label class="control-label" for="username">ADJUNTAR DETALLES</label>
			<div class="controls">
			<input type="file" name="doc"   class="span4" >
				@if ($errors->has('doc'))
				<span class="help-block">
				<strong>{{ $errors->first('doc') }}</strong>
				</span>
				@endif
			</div> <!-- /controls -->				
			</div>

			
			<div class="control-group">											
			<label class="control-label" for="username">ASIGNAR A</label>
			<div class="controls">
			<select class="span4" id="assignto" name="assignto">
			@foreach($agents as $agent)
			<option value="{{$agent->id}}">{{ucfirst($agent->fname)}}</option>
			@endforeach
			</select>

			</div> <!-- /controls -->				
			</div>
			<div class="control-group">											
			<label class="control-label" for="username">FECHA DE VENCIMIENTO</label>
			<div class="controls">
			<input type="text" class="span3 datepickert" id="datepicker" name="duedate">
			@if ($errors->has('duedate'))
				<span class="help-block">
				<strong>{{ $errors->first('duedate') }}</strong>
				</span>
				@endif
			</div> <!-- /controls -->				
			</div>

			

				<div class="control-group">											
			<label class="control-label" for="username">OBSERVACIONES</label>
			<div class="controls">
			<textarea type="text" class="span6 ckeditor" id="details" name="details" rows="6"></textarea>
				@if ($errors->has('details'))
				<span class="help-block">
				<strong>{{ $errors->first('details') }}</strong>
				</span>
				@endif
			</div> <!-- /controls -->				
			</div>
<div class="control-group">											
			<label class="control-label" for="task_price">EXPEDIENTE PRECIO</label>
			<div class="controls">
			<input type="text" class="span3" id="task_price" name="task_price" value="{{old('task_price')}}">
			@if ($errors->has('task_price'))
			<span class="help-block">
			<strong>{{ $errors->first('task_price') }}</strong>
			</span>
			@endif
			</div> <!-- /controls -->				
			</div>
			<div class="control-group">											
			<label class="control-label" for="username">ESTADO</label>
			<div class="controls">
			<select class="span4" id="status" name="status">
			<option value="nuevoexpeditene" selected>NUEVO EXPEDIENTE</option>
			<option value="enproceso">EN PROCESO</option>
			</select>

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
		

		$("#add-task").validate({
			rules: 
			{
				title: "required",
				dia_id: "required",
				reference_number: "required",
				phone_number: {
				required: true,
				maxlength: 30
				},
				contact_person: {
				required: true,
				maxlength: 50
				},
				task_price: {
					number: true
				},
				duedate: {
				required: true,
				},

				doc: {
				extension: "xls|csv|docx|txt|jpeg|jpg|png|gif|doc|ppt|pptx|pdf",
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
				dia_id: "Por favor escribe DIA-ID",
				reference_number: "Por favor escribe Ref.ac",
				duedate: {
				required: "Seleccione Fecha",
				},	
				phone_number: {
				required: "Por favor ingrese el teléfono",
				maxlength: "El teléfono del sitio no puede tener más de 30 caracteres",
				},
				contact_person: {
				required: "Por favor ingrese el contacto",
				maxlength: "El contacto del sitio no puede tener más de 50 caracteres",
				},
				task_price: {
					number: "Solo se permiten números",
				},
				doc: {
					extension: "Solo archivo permitido extention xls,csv,docx,txt,jpeg,jpg,png,gif,doc,ppt,pptx",
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
$(document).ready(function(){
document.getElementById('datepicker').value='<?php echo $date_afte14_days; ?>';
});
</script> 
@endsection