@extends('layouts.team')
@section('title', '')
@section('content')

<div class="account-container">
    
    <div class="content clearfix">
        
        <form class="form-horizontal" method="POST" action="{{url('/password/reset/now')}}" id="reset-pass">
                        {{ csrf_field() }}
            <input type="hidden" name="emailtoken" value="{{$data['token']}}">
            <input type="hidden" name="email" value="{{$data['email']}}">
            <h1>Reset Password</h1>       
            
            <div class="login-fields">
                
                
                <div class="field">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" value="" placeholder="password" class="login password-field"  />
                      @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                   
                </div> <!-- /password -->

                 <div class="field">
                    <label for="password_confirmation">Contraseña:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="password confirmation" class="login password-field"  data-rule-equalTo="#password"/>
                      @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>password_confirmation
                    @endif
                     @if(session()->has('message'))
                    <span class="help-block">
                    <a href="{{url('/team/login')}}" class="button btn btn-info">Login</a>
                    <strong>{{ session()->get('message') }}</strong>
                    </span>
                    @endif
                </div> <!-- /password_confirmation -->
                
            </div> <!-- /login-fields -->
            <div class="login-actions">
                <button class="button btn btn-success btn-large">Iniciar Sesión</button>
                
            </div> <!-- .actions -->
            
            
            
        </form>
        
    </div> <!-- /content -->
    
</div> <!-- /account-container -->

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
        

        $("#reset-pass").validate({
            rules: 
            {

                email: {
                required: true,
                email: true
                },
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
               
                email:
                {
                    required:"Por favor, introduzca la dirección de correo electrónico",
                    email:"Por favor ingrese una dirección de correo electrónico válida"
                },
                password: {
                required: "Proporcione una contraseña",
                minlength: "Su contraseña debe tener al menos 5 caracteres"
                },
                password_confirmation: {
                required: "Confirmar contraseña",
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