@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="account-container">
    
    <div class="content clearfix">
        
         <form id="login" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
            <h1>Iniciar Sesión</h1>     
            
            <div class="login-fields">
                
                  
                
                <div class="field">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" id="username" name="username" value="" placeholder="Nombre de usuario" class="login username-field" />
                     @if ($errors->has('username'))
                    <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div> <!-- /field -->
                
                <div class="field">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" value="" placeholder="Contraseña" class="login password-field"/>
                    @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div> <!-- /password -->
                
            </div> <!-- /login-fields -->
            
            <div class="login-actions">
                
                <span class="login-checkbox">
                    <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                     
                </span>
                                    
                <button class="button btn btn-success btn-large">Iniciar Sesión
</button>
                
            </div> <!-- .actions -->
            
            
            
        </form>
        
    </div> <!-- /content -->
    
</div> <!-- /account-container -->
<div class="login-extra">
    <a href="{{url('password/reset')}}">Restablecer la Contraseña</a>
</div> <!-- /login-extra -->
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
        

        $("#login").validate({
            rules: 
            {
                username: {
                    required: true,
                    
                },

              
                password: {
                    required: true,
                    
                },
         


            },
            messages:
             {
                username: {
                    required: "Por favor, ingrese un nombre de usuario",
                    
                },
                 password: {
                required: "porfavor ingrese una contraseña",
               
                },
               

                
            },
            errorPlacement: function(error, element) {
            
            error.insertAfter(element);
            
            }
        });

    
    });
</script> 
@endsection
