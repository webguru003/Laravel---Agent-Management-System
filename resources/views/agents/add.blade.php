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
	      				<h3>Perfil del agente</h3>
	  				</div> 
					
					<div class="widget-content">
	<form id="add-agent" class="form-horizontal" method="POST" action="{{ route('agents.store') }}">
				{{ csrf_field() }}
				<fieldset>

				<div class="control-group">											
				<label class="control-label" for="username">Nombre de usuario
				</label>
				<div class="controls">
				<input type="text" class="span6" id="username" name="username" value="{{old('username')}}">
				@if ($errors->has('username'))
				<span class="help-block">
				<strong>{{ $errors->first('username') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->


				<div class="control-group">											
				<label class="control-label" for="firstname">Nombre</label>
				<div class="controls">
				<input type="text" class="span6" id="firstname" name="fname" value="{{old('fname')}}">
				@if ($errors->has('fname'))
				<span class="help-block">
				<strong>{{ $errors->first('fname') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->


				<div class="control-group">											
				<label class="control-label" for="lastname">Apellido</label>
				<div class="controls">
				<input type="text" class="span6" id="lastname" name="lname" value="{{old('lname')}}">
				@if ($errors->has('lname'))
				<span class="help-block">
				<strong>{{ $errors->first('lname') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->


				<div class="control-group">											
				<label class="control-label" for="email">Email</label>
				<div class="controls">
				<input type="text" class="span4" id="email" name="email" value="{{old('email')}}">
				@if ($errors->has('email'))
				<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->


				<div class="control-group">											
				<label class="control-label" for="phone">TEL</label>
				<div class="controls">
				<input type="text" class="span4" id="phone" name="phone" value="{{old('phone')}}">
				@if ($errors->has('phone'))
				<span class="help-block">
				<strong>{{ $errors->first('phone') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->


				<div class="control-group">											
				<label class="control-label" for="password1">Contraseña</label>
				<div class="controls">
				<input type="password" class="span4" id="password" name="password" >
				@if ($errors->has('password'))
				<span class="help-block">
				<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->


				<div class="control-group">											
				<label class="control-label" for="password_confirmation">Confirmar</label>
				<div class="controls">
				<input type="password" class="span4" id="password_confirmation" name="password_confirmation" data-rule-equalTo="#password">
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
		

		$("#add-agent").validate({
			rules: 
			{
				username: {
					required: true,
					minlength: 5
				},

				fname: "required",
				lname: "required",

				email: {
				required: true,
				email: true
				},
				phone: "required",
				password: {
					required: true,
					minlength: 5
				},
			
			password_confirmation: {
					required: true,
					minlength: 5
					},


			},
			messages:
			 {
				username: {
					required: "Por favor, ingrese un nombre de usuario",
					minlength: "Su nombre de usuario debe constar de al menos 5 caracteres",
				},

				fname: "Por favor, escriba su nombre",
				lname: "Por favor, introduzca el apellido",
				email:
				{
					required:"Por favor, introduzca la dirección de correo electrónico",
					email:"Por favor ingrese una dirección de correo electrónico válida"
				},
				phone: "por favor ingrese el número de teléfono",
				password: {
				required: "Proporcione una contraseña",
				minlength: "Su contraseña debe tener al menos 5 caracteres"
				},
				password_confirmation: {
				required: "Proporcione una contraseña",
				minlength: "Su contraseña debe tener al menos 5 caracteres",
				equalTo: "Ingrese la misma contraseña que anteriormente",
				},

				
			},
			errorPlacement: function(error, element) {
			
			error.insertAfter(element);
			
			}
		});

	
	});
</script> 
@endsection