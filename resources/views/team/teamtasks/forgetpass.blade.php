@extends('layouts.teamindex')
@section('title', '')
@section('content')
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
					 <form action="{{url('/team/passupdate')}}" method="post" id="teamtask" class="form-horizontal">
					 <input type="hidden" name="id" value="<?php if (session()->has('team_user_id'))
{
             
            $username=App\User::where('id', session()->get('team_user_id'))->first();
            echo $username->id;
}
            ?>">
        				{{ csrf_field() }}
						 <?php if(isset($mess)) { echo $mess; } ?>
					<fieldset>

					 
					<div class="control-group">											
                    <h3>Nueva contraseña</h3>
                    <div class="controls">
                     <input type="password" name="newpass" id="newpass" value="">
                    </div> <!-- /controls -->				
                    </div>
                    <div class="control-group">											
                    <h3>Reescriba Nueva contraseña</h3>
                    <div class="controls">
                     <input type="password" name="rnewpass" id="rnewpass" value="">
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
            
				newpass: {
				required: true,
				},
				rnewpass: {
				required: true,
				},
         
		},
            messages:
             {
	                newpass: {
	                 
	                    number: "Nueva contraseña", 
	                },
	                
	                rnewpass: {
	                     required: "Reescriba nueva contraseña",

	                },
	                 
            },
            errorPlacement: function(error, element) {
            
            error.insertAfter(element);
            
            }
        });

    
    });
    </script>

@endsection