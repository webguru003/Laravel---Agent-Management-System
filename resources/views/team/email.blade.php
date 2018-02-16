@extends('layouts.team')
@section('title', '')
@section('content')
<div class="navbar navbar-fixed-top">
    
    <div class="navbar-inner">
        
        <div class="container">
            
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            
            <a class="brand" href="{{url('/team/login')}}">
                DIAA              
            </a>        
            
            <div class="nav-collapse">
                <ul class="nav pull-right">
                
                                                 <li><a href="{{url('/team/login')}}">Login</a></li>
               
                    </ul>
                           </div><!--/.nav-collapse -->    
    
        </div> <!-- /container -->
        
    </div> <!-- /navbar-inner -->
    
</div>
<div class="account-container">
    
    <div class="content clearfix">
        <form id="sendemail" method="POST" action="{{ url('/emaillink') }}">
                        {{ csrf_field() }}
        
            <h1>Se te olvidó tu contraseña</h1>     
            
            <div class="login-fields">
                <div class="field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="username">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email " class="login username-field" />
                    @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                    {{ session()->get('message') }}
                    </div>
                    @endif
                </div> <!-- /field -->
            </div> <!-- /login-fields -->
            
            <div class="login-actions">
                <button class="button btn btn-success btn-large">Reiniciar</button>
            </div> <!-- .actions -->
            
            
            
        </form>
        
    </div> <!-- /content -->
     
</div> <!-- /account-container -->



<div class="login-extra">
    <a href="{{url('/')}}">Volver a la página de inicio de sesión</a>
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
        

        $("#sendemail").validate({
            rules: 
            {
             email: {
                required: true,
                email: true
                },
             
            },
            messages:
             {
              
                 email:
                {
                    required:"Por favor, introduzca la dirección de correo electrónico",
                    email:"Por favor ingrese una dirección de correo electrónico válida"
                },

            },
            errorPlacement: function(error, element) {
            
            error.insertAfter(element);
            
            }
        });

    
    });
</script> 
@endsection
