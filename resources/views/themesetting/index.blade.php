@extends('layouts.app')
@section('title', 'Réglage')
@section('content')
<style>
.row{margin:0px;}
</style>
<script src="{{ asset('jscolor/jscolor.js') }}"></script>
<div class="container">
<form id="themetext-setting" class="form-horizontal" method="POST" action="{{url('/theme/setting')}}">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{$setting->id}}">
<div class="row">
	      	
	<div class="widget ">

		<div class="widget-header">
		<i class=""></i>
		<h3>Texto del tema</h3>
		</div><!-- widget-header end -->

		<div class="widget-content">
		

				<div class="control-group">											
				<label class="control-label" for="site_title">
				Título del sitio
				</label>
				<div class="controls">
				<input type="text" class="span3" id="site_title" name="site_title" value="{{$setting->stext}}">
				@if ($errors->has('site_title'))
				<span class="help-block">
				<strong>{{ $errors->first('site_title') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
				<label class="control-label" for="footer_text">
				Texto de pie de página
				</label>
				<div class="controls">
				<input type="text" class="span3" id="footer_text" name="footer_text" value="{{$setting->ftext}}">
				@if ($errors->has('footer_text'))
				<span class="help-block">
				<strong>{{ $errors->first('footer_text') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				

				
		
			
		</div><!-- widget-content end -->
		

	</div> <!-- widget end -->

</div><!-- row end -->

<div class="row">
	      	
	<div class="widget ">

		<div class="widget-header">
		<i class=""></i>
		<h3>Colores del tema</h3>
		</div><!-- widget-header end -->

		<div class="widget-content">
			
			<div class="control-group">											
				<label class="control-label" for="header_color">
				Color del encabezado
				</label>
				<div class="controls">
			<input type="text" class="span3 jscolor" id="header_color" name="header_color" value="{{$setting->hcolor}}">
				@if ($errors->has('header_color'))
				<span class="help-block">
				<strong>{{ $errors->first('header_color') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
				<label class="control-label" for="footer_color">
				Color del pie de página
				</label>
				<div class="controls">
				<input type="text" class="span3 jscolor" id="footer_color" name="footer_color" value="{{$setting->fcolor}}">
				@if ($errors->has('footer_color'))
				<span class="help-block">
				<strong>{{ $errors->first('footer_color') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->
	
		</div><!-- widget-content end -->
		</div> <!-- widget end -->

</div><!-- row end -->

<div class="row">
	      	
	<div class="widget ">

		<div class="widget-header">
		<i class=""></i>
		<h3>Configuración de factura</h3>
		</div><!-- widget-header end -->

		<div class="widget-content">
			
			<div class="control-group">											
				<label class="control-label" for="kiometers_price">
				Kilómetros Precio
				</label>
				<div class="controls">
			<input type="text" class="span3 " id="kiometers_price" name="kiometers_price" value="{{$setting->kiometers_price}}">
				@if ($errors->has('kiometers_price'))
				<span class="help-block">
				<strong>{{ $errors->first('kiometers_price') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->


					<div class="control-group">											
				<label class="control-label" for="fixed_kilometers">
				Bill después de kilómetros
				</label>
				<div class="controls">
			<input type="text" class="span3 " id="fixed_kilometers" name="fixed_kilometers" value="{{$setting->fixed_kilometers}}">
				@if ($errors->has('fixed_kilometers'))
				<span class="help-block">
				<strong>{{ $errors->first('fixed_kilometers') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->



				<div class="control-group" style="display:none;">											
				<label class="control-label" for="numberofimages_price">
				No. de Imágenes Precio
				</label>
				<div class="controls">
				<input type="text" class="span3" id="numberofimages_price" name="numberofimages_price" value="{{$setting->numberofimages_price}}">
				@if ($errors->has('numberofimages_price'))
				<span class="help-block">
				<strong>{{ $errors->first('numberofimages_price') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
                <div class="control-group">											
				<label class="control-label" for="vat">
				VAT %
				</label>
				<div class="controls">
				<input type="text" class="span3" id="vat" name="vat" value="{{$setting->vat}}">
				@if ($errors->has(''))
				<span class="help-block">
				<strong>{{ $errors->first('') }}</strong>
				</span>
				@endif
				</div> <!-- /controls -->				
				</div> <!-- /control-group -->

                
		</div><!-- widget-content end -->
		</div> <!-- widget end -->

</div><!-- row end -->
		
				<button type="submit" class="btn btn-primary">Guardar</button> 
			
				
		</form>
</div><!-- container end -->

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
		

		$("#themetext-setting").validate({
			rules: 
			{
				site_title: {
					required: true,
					maxlength: 20
				},

				footer_text: {
					required: true,
					maxlength: 20
				},
				kiometers_price: {
					required: true,
					number: true
				},

				fixed_kilometers: {
				required: true,
				number: true
				},
				/*numberofimages_price: {
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
				site_title: {
					required: "Introduzca el título del sitio",
					maxlength: "El título del sitio no puede tener más de 50 caracteres",
				},

				footer_text: {
					required: "Introduzca un texto de pie de página",
					maxlength: "El texto de pie de página no puede tener más de 50 caracteres",
				},
				kiometers_price: {
					required: "Introduzca el precio del kilómetro",
					number: "Solo se permiten números",
				},
				fixed_kilometers: {
					required: "Introduzca el después de kilómetros",
					number: "Solo se permiten números",
				},
				/*numberofimages_price: {
					required: "Please enter No. of Images Price",
					number: "Only numbers are allowed",
				},*/
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
@endsection