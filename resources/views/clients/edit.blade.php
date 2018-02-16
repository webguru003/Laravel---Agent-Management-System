@extends('layouts.app')
@section('title', 'Añadir')
@section('content')
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	
	      	<div class="span12">      		
	      		
	      		<div class="widget ">
	      			
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Información del Cliente</h3>
	  				</div> 
					
					<div class="widget-content">
					 	
				<div class="tab-pane" id="formcontrols">
				<form id="edit-client" class="form-horizontal" method="POST" action="{{url("/clients/$client->id")}}">
				{{ method_field('PUT') }}
				{{ csrf_field() }}
				<fieldset>

				<div class="control-group">											
				<label class="control-label" for="username">Nombre del cliente
				</label>
				<div class="controls">
				<input type="text" class="span6" id="contactname" name="contactname" value="{{$client->contactname}}">
				@if ($errors->has('contactname'))
				<span class="help-block">
				<strong>{{ $errors->first('contactname') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->


				<div class="control-group">											
				<label class="control-label" for="firstname">Nombre de Empresa
				</label>
				<div class="controls">
				<input type="text" class="span6" id="companyname" name="companyname" value="{{$client->companyname	}}">
				@if ($errors->has('companyname'))
				<span class="help-block">
				<strong>{{ $errors->first('companyname') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->

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
		

		$("#edit-client").validate({
			rules: 
			{
				contactname: "required",
				companyname: "required",

			},
			messages:
			 {
				contactname: "Introduzca el nombre del cliente",
				companyname: "Introduzca el nombre de la empresa",
				
			},
			errorPlacement: function(error, element) {
			
			error.insertAfter(element);
			
			}
		});

	
	});
</script>
@endsection