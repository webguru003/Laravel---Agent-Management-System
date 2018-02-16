@extends('layouts.teamindex')
@section('title', '')
@section('content')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('js/timepicker/timepicker.min.css') }}">
<script src="{{ asset('js/timepicker/timepicker.min.js') }}"></script>
<div class="main teamarea">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	
	      	<div class="span12">      		
	      		
	      		<div class="widget ">
				<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Informaci&oacute;n sobre el informe</h3>
	  				</div> 
					
					<div class="widget-content">
					 	
					<div class="tab-pane" id="formcontrols">
					 <form action="{{url('/teamtask/update')}}" method="post" id="teamtask" class="form-horizontal">
					 <input type="hidden" name="id" value="{{$task->id}}">
        				{{ csrf_field() }}
					<fieldset>

					<div class="control-group">											
					<h3>Riesgo</h3>
					<div class="controls">
					{{$task->title}}	

					</div> <!-- /controls -->				
					</div> <!-- /control-group -->


					@if(isset($task->asegurado))
					<div class="control-group">											
					<h3>Asegurado</h3>
					<div class="controls">
					{{$task->asegurado}}	
					</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					@endif

					@if(isset($task->asegurado))
					<div class="control-group">											
					<h3>Ref.Arag</h3>
					<div class="controls">
					{{$task->reference_number}}	
					</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					@endif


					<div class="control-group">											
					<h3>Contacto</h3>
					<div class="controls">
					{{$task->contact_person}}

					</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group">											
					<h3>Tel&eacute;fono</h3>
					<div class="controls">
					<a href="tel:{{$task->phone_number}}">{{$task->phone_number}}</a>	

					</div> <!-- /controls -->				
					</div> <!-- /control-group -->


					<div class="control-group" style="display:none;">											
					<h3>Nombre de empresa</h3>
					<div class="controls">
					@php
					$clientname=App\Client::where('id', $task->clients_id)->first();
					echo $clientname->contactname;
					@endphp	
					</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					@if(isset($task->details))
					<div class="control-group">											
					<h3>Observaciones DIA</h3>
					<div class="controls">
						<textarea class="span4 ckeditor" rows="3" id="detail"  disabled="disabled">{{$task->details}}</textarea>
					</div> <!-- /controls -->				
					</div>
					@endif

					@if($task->attach_file !== "" && Storage::exists('public/details/'.$task->attach_file))
					<div class="control-group">											
					<h3>Archivo Adjunto Detalles</h3>
					<div class="controls">
					@php $url = url('storage/app/public/details/'.$task->attach_file); @endphp
					<a href="{{$url}}" target="_blank">Ver Archivo</a>
					</div> <!-- /controls -->				
					</div>
					@endif

					@if ($task->modification)	
					<div class="control-group" style="border: 2px solid red; padding: 15px; " ><h3>Amendments</h3>
					<div class="controls">{{strip_tags($task->modification)}}
					 </div> <!-- /controls -->				
					</div>
					@endif

					
                    
                    <div class="control-group">											
                    <h3>Estado</h3>
                    <div class="controls">
                    <select class="span4" id="taskstatus" name="status">
                    <option value=""> Select</option>
                    @if($task->status=="nuevoexpeditene")
	                    <option value="enproceso" @php if($task->status=="enproceso"){echo "selected";} @endphp>
	                   	EN PROCESO</option>
	                   	@else
	                   	<option value="enproceso" @php if($task->status=="enproceso"){echo "selected";} @endphp>
	                   	EN PROCESO</option>
						<option value="incicencia" @php if($task->status=="incicencia"){echo "selected";} @endphp>
						INCICENCIA</option>
	                    <option value="noresponde" @php if($task->status=="noresponde"){echo "selected";} @endphp>
	                    NO RESPONDE</option>
						<option value="reunionfija" @php if($task->status=="reunionfija"){echo "selected";} @endphp>
	                    VISITA CONCERTADA</option>
	                    <option value="visitada" @php if($task->status=="visitada"){echo "selected";} @endphp>
						VISITADA</option>
	                @endif
                    </select>
                    </div> <!-- /controls -->				
                    </div>

                    	<div class="control-group taskinfo">											
							<h3>Fecha Visita</h3>
							@php
							if(isset($task->meeting_date))
							{
								$meeting_date=explode("-",$task->meeting_date);
								$meeting_date=$meeting_date[2]."-".$meeting_date[1]."-".$meeting_date[0];
							}
							else{$meeting_date="";}
							@endphp
							<div class="controls">
							<input type="text" class="span3 datepickert" id="meeting_date" name="meeting_date" value="{{$meeting_date}}">
                         	</div> <!-- /controls -->				
							</div>
							  @if ($errors->has('meeting_date'))
                            <span class="help-block">
                            <strong>{{ $errors->first('meeting_date') }}</strong>
                            </span>
                            @endif

							<div class="control-group taskinfo">											
							<h3>Hora</h3>
							<div class="controls">  
							<input type="text" class="span3 timepicker" name="meeting_time" value="{{$task->meeting_time}}">
                            @if ($errors->has('meeting_time'))
                            <span class="help-block">
                            <strong>{{ $errors->first('meeting_time') }}</strong>
                            </span>
                            @endif
							</div> <!-- /controls -->				
							</div>
                    
<div class="control-group" style="clear: both;">											
							<span class="led-red"></span> <label class="control-label">MENSAJE POR PERITO</label>
							<div class="controls">
<?php 
foreach ($comments as $comment) 
{
	if($comment->userid == 'admin') 
	{ 
		$cu_name = 'administrador';
		$csss  =   'background-color: #cdfec9;padding: 15px;border-radius: 15px;margin-bottom: 5px;margin-left: 100px;clear: both;'; 
	} 
	else 
	{ 
		 $cu_ageent = DB::select('select * from users where id = ?', [$comment->userid]);
		 foreach ($cu_ageent as $cu_ageents) {
			$cu_name = $cu_ageents->username;
		 }
		 $csss  = 'background-color: #eceeee;padding: 15px;border-radius: 15px;margin-bottom: 5px;margin-right: 100px;clear: both;'; 
	   
	 }
    echo "<div style='".$csss."'><h3>".$cu_name."</h3>";
    echo "<p>".$comment->datetime."</p>";
    echo "<p>".$comment->comments."</p></div>";
} 
?>
							</div>		<!-- /controls -->		
							</div>					<div class="control-group" >											
					<h3>Observaciones Perito</h3>
					<div class="controls">
					<textarea class="span6 ckeditor" rows="6" id="message" name="message">{{$task->message}}</textarea>
					@if ($errors->has('message'))
					<span class="help-block">
					<strong>{{ $errors->first('message') }}</strong>
					</span>
					@endif
					</div> <!-- /controls -->				
					</div>
 <div class="control-group" >											
					<h3>Kil&oacute;metros</h3>
					<div class="controls">
					<input type="hidden" id="assign_to" name="assign_to" value="{{$task->assign_to}}">
                    <input type="text" class="span6" id="kilometers" name="kilometers" value="{{$task->kilometers}}">
					@if ($errors->has('kilometers'))
					<span class="help-block">
					<strong>{{ $errors->first('kilometers') }}</strong>
					</span>
					@endif
					
					</div> <!-- /controls -->				
					</div>
					<div class="form-actions">
					<button type="submit" class="btn btn-primary">Actualizar</button> 
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
        

       $("#teamtask").validate({
        rules: 
        {
                kilometers: {
                   number: true,
					},
					meeting_date: {
				required: true,
				},
				meeting_time: {
				required: true,
				},
         
		},
            messages:
             {
	                kilometers: {
	                 
	                    number: "Ingrese s�lo n�meros", 
	                },
	                
	                meeting_date: {
	                     required: "Seleccione Fecha",

	                },
	                 meeting_time: {
	                     required: "Seleccione Time",
	                },
  
            },
            errorPlacement: function(error, element) {
            
            error.insertAfter(element);
            
            }
        });

    
    });

 $(document).ready(function(){
    $('.taskinfo').hide(); 
     if($('#taskstatus').val() == 'reunionfija') {
            $('.taskinfo').show();
			if(document.getElementById('meeting_date').value=='')
			{
				document.getElementById('meeting_date').value='<?php echo date('d-m-Y'); ?>';	
			} 
        }
});
$('#taskstatus').change(function(){
        if($('#taskstatus').val() == 'reunionfija') 
        {
            $('.taskinfo').show(); 
			if(document.getElementById('meeting_date').value=='')
			{
				document.getElementById('meeting_date').value='<?php echo date('d-m-Y'); ?>';	
			}
		}
         else {
            $('.taskinfo').hide(); 
        	}
        
    });


$(document).ready(function(){


    $('input.timepicker').timepicker({
    	timeFormat: 'HH:mm:ss',
    interval: 30,
    dynamic: true,
    defaultTime: '09:00:00',
    startTime: '09:00:00',
    dropdown: true,
    scrollbar: true
    });
});
    </script>

@endsection