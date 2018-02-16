@extends('layouts.app')
@section('title', '')
@section('content')
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	
	      	<div class="span12">      		
	      		
	      		<div class="widget ">
	      			
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Facturas</h3>
	  				</div> 
					
					<div class="widget-content">
					 	
						 		<div class="tab-pane" id="formcontrols">
                        <form id="create-invoice" class="form-horizontal" method="POST" action="{{ route('invoices.store') }}">
                        {{ csrf_field() }}
                        <fieldset>
                        
                        <div class="control-group" style="display:none;">											
                        <label class="control-label" for="username">Clientela</label>
                        <div class="controls">
                        <select class="span4" id="companyname" name="companyname">
                        <option>ABC Company</option>
                        <option>DEF Org</option>
                        <option>GHI Comp</option>
                        <option>JKL Limited</option>
                        </select>
                        
                        </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                         <div class="control-group">											
                        <label class="control-label" for="task_id">Informe Riesgo</label>
                        <div class="controls">
                        <select class="span4" id="task_id" name="task_id">
                        @php $tasks = App\Task::where([
                        ['status','!=', "facturada"],
                        ['task_startdate', '!=', null]
                        ])->get();@endphp
                        @foreach($tasks as $task)
                        <option value="{{$task->id}}">{{ucfirst($task->title)}}</option>
                        @endforeach
                        </select>
                        @if ($errors->has('task_id'))
                        <span class="help-block">
                        <strong>{{ $errors->first('task_id') }}</strong>
                        </span>
                        @endif
                        </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        
                        <div class="control-group">											
                        <label class="control-label" for="date">Fecha
                        </label>
                        <div class="controls">
                        <input type="text" class="span3 datepickert" id="date" name="date">
                        @if ($errors->has('date'))
                        <span class="help-block">
                        <strong>{{ $errors->first('date') }}</strong>
                        </span>
                        @endif
                        </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

						<div class="control-group taskinfo">											
						<label class="control-label" for="task_price">Expediente Precio</label>
						<div class="controls">
						<input type="text" class="span3" id="task_price" name="task_price" value="">
						@if ($errors->has('task_price'))
						<span class="help-block">
						<strong>{{ $errors->first('task_price') }}</strong>
						</span>
						@endif
						</div> <!-- /controls -->				
						</div>
                        
                        <div class="control-group">											
                        <label class="control-label" for="Kilómetros">Kilómetros</label>
                        <div class="controls">
                        <input type="text" class="span3" id="kilometers" name="kilometers" value="">
                        @if ($errors->has('kilometers'))
                        <span class="help-block">
                        <strong>{{ $errors->first('kilometers') }}</strong>
                        </span>
                        @endif
                        </div> <!-- /controls -->				
                        </div>


						<div class="control-group">											
						<label class="control-label" for="invoice_number">Número de Factura</label>
						<div class="controls">
						<input type="text" class="span3" id="invoice_number" name="invoice_number" >
						@if ($errors->has('invoice_number'))
						<span class="help-block">
						<strong>{{ $errors->first('invoice_number')}}</strong>
						</span>
						@endif
						</div> <!-- /controls -->				
						</div>

                        <div class="control-group" style="display:none;">											
                        <label class="control-label" for="numberofimages">Número de imágenes</label>
                        <div class="controls">
                        <input type="text" class="span3" id="numberofimages" name="numberofimages">
                        @if ($errors->has('numberofimages'))
                        <span class="help-block">
                        <strong>{{ $errors->first('numberofimages') }}</strong>
                        </span>
                        @endif
						</div> <!-- /controls -->				
                        </div>
                        
                        <div class="control-group">											
                        <label class="control-label" for="vat">Vat (%)</label>
                        <div class="controls">
                        @php $setting = App\Setting::first();@endphp
                        <input type="text" class="span3" id="vat" name="vat" value="{{$setting->vat}}" readonly="readonly">
                        @if ($errors->has('vat'))
                        <span class="help-block">
                        <strong>{{ $errors->first('vat') }}</strong>
                        </span>
                        @endif
				 		</div> <!-- /controls -->				
                        </div>
                        
                        <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Guardar</button> 
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
<script type="text/javascript">
$.validator.setDefaults({
		 errorLabelContainer: ".messageBox",
  		 wrapper: "span",
		submitHandler: function() 
		{
			form.submit();
		},
	});

	$().ready(function() {
		

		$("#create-invoice").validate({
			rules: 
			{

				task_id: {
					required: true,
				},
				date: {
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
				/*numberofimages: {
					required: true,
					number: true
				},*/
				vat: {
					required: true,
					number: true,
					max: 100
				},
			},
			messages:
			 {
				

				task_id: {
					required: "Crear Expediente",
				},
				date: {
					required: "Por favor, seleccione la fecha",
				},
				kilometers: {
					required: "Introduzca el kilómetro ",
					number: "Solo se permiten números",
				},
				task_price: {
					required: "Introduzca el expediente precio ",
					number: "Solo se permiten números",
				},
				/*numberofimages: {
					required: "Please enter No. of Images ",
					number: "Only numbers are allowed",
				},*/
				invoice_number: {
					required: "Introduzca el, número de factura",
				},
				vat: {
					required: "Por favor escribe VAT",
					number: "Solo se permiten números",
				},
			},
			errorPlacement: function(error, element) {
			
			error.insertAfter(element);
			
			}
		});

	
	});
   </script>

   <script>
$(document).ready(function()
{ 
var id=$('#task_id :selected').val();   
sendTaskid(id);
	
});

$('#task_id').change(function()
{
var id=$('#task_id :selected').val();   
sendTaskid(id);
});

function sendTaskid(taskid)
{
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var url = "<?php echo url('/task/data/get'); ?>";
	$.ajax({
		type: "POST",
		url: url,
		data: {
		'taskid' :taskid,
		},
		success: function(data)
		{					
			$('#task_price').attr('value', data.task_price);
			$('#kilometers').attr('value', data.kilometers);
		},

		error: function(data)
		{
			console.log(data.responseText);
		}

	});

}
    </script>
@endsection