<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/pages/dashboard.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('font/fonts.css')}}" rel="stylesheet">
    
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/pages/signin.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet" type="text/css">

<script src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/signin.js') }}"></script>
<script src="{{ asset('js/excanvas.min.js') }}"></script>
<script src="{{ asset('js/Chart.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="{{ asset('js/full-calendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/base.js') }}"></script>
<script src="{{ asset('validate/dist/jquery.validate.js') }}"></script>
<script src="{{ asset('validate/dist/additional-methods.js') }}"></script>
 @php $setting =  DB::table('settings')->first();
if(count($setting) <= 0)
{
$setting->hcolor="#00ba8b";  
$setting->fcolor="#292929";
$setting->stext="";
}
@endphp
<style type="text/css">
 .navbar-inner
 {
    background-color:#{{$setting->hcolor}} !important;
 } 
 .footer-inner {
background-color:#{{$setting->fcolor}} !important;
} 
.footer {
    border-top: 1px solid #{{$setting->fcolor}} !important;;
} 

</style>
</head>
<body>
   
    <div class="navbar navbar-fixed-top">
    
    <div class="navbar-inner">
        
        <div class="container">
            
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            
            <a class="brand" href="{{ url('/home') }}">
               <img src="{{ url('img/logo.png') }}" width="300"> 
            </a>        
            
            <div class="nav-collapse">
                <ul class="nav pull-right">
                
                     @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
               
                    </ul>
                           </div><!--/.nav-collapse -->    
    
        </div> <!-- /container -->
        
    </div> <!-- /navbar-inner -->
    
</div> <!-- /navbar -->
                    @else
                            @php $id = Auth::id(); @endphp

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="icon-user"></i>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url("/theme/setting")}}">Réglage</a></li>
                                <li><a href="{{url("/agents/$id/edit")}}">Perfil</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        
                         </ul>


                 
            </div><!--/.nav-collapse -->    
    
        </div> <!-- /container -->
        
    </div> <!-- /navbar-inner -->
    
</div> <!-- /navbar -->

<div class="subnavbar">
        <div class="subnavbar-inner">
            <div class="container">
                 <ul class="mainnav">
                    <li class="active"><a href="{{url('/')}}"><i class="icon-dashboard"></i><span>Tablero</span> </a>
                    </li>
                    <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user"></i><span>Peritos</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <li><a href="{{url('/agents/create')}}">Añadir</a></li>
                        <li><a href="{{url('/agents')}}">Lista</a></li>
                        <li><a href="{{url('/agents/reports/all')}}">Informes</a></li>
                        <li><a href="{{url('/agentinvoices')}}">Facturas</a></li>
                        </ul>
                    </li>                   
                     <li class="dropdown" style="display:none;"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-book"></i><span>Clientela</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/clients/create')}}">Añadir</a></li>
                            <li><a href="{{url('/clients')}}">Lista</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-tasks"></i><span>Informes</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/tasks/create')}}">Añadir</a></li>
                            <li><a href="{{url('/tasks')}}">Lista</a></li>
                            <li><a href="{{url('/tasks/completed/all')}}">Finalizados</a></li>
                            <li><a href="{{url('/report/list')}}">Listados</a></li>
                         </ul>
                    </li>
                    <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-tasks"></i><span>Facturas</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/invoices/create')}}">Añadir</a></li>
                            <li><a href="{{url('/invoices')}}">Lista</a></li>
                         </ul>
                    </li>
                     <li>  <a href="{{ route('logout') }}"   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="icon-dashboard"></i><span>
                                Cerrar sesión</span> </a></li>
</ul>
            </div></div>
        
    </div>
 @endif


        @yield('content')
 


 @if (!Auth::guest())
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; <?php echo date("Y"); ?> <a href="#">Disseny i Arquitectura Taller Pericial SL</a> </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
@endif
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Estás seguro ?');
    });
  $(function() {
               $(".datepickert").datepicker({ dateFormat: "dd-mm-yy" }).val()
       });

  $( '.dropdown')
  .mouseenter(function() {
    $(this ).addClass('open');
  })
  .mouseleave(function() {
    $(this ).removeClass('open');
  });

</script>
</body>

</html>

