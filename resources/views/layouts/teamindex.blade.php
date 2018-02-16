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
<script src="{{ asset('js/chart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="{{ asset('js/full-calendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/base.js') }}"></script>

 
    <script src="{{ asset('validate/dist/jquery.validate.js') }}"></script>
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
    <div class="container">  <a class="brand" href="{{url('/team/login')}}"><img src="http://www.diatp.eu/diaapp/img/logo.png" width="300"></a>
        <ul class="nav pull-right">
             <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="icon-user"></i>
            @if (session()->has('team_user_id'))
            @php 
            $username=App\User::where('id', session()->get('team_user_id'))->first();
            echo $username->username;
            @endphp
            @endif    
            <span class="caret"></span>
            </a>
          <ul class="dropdown-menu" role="menu">
                                      <li>
                                    <a href="{{url('/team/password')}}">Perfil</a>

                                    <form id="logout-form" action="{{url('/team/logout')}}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    </form>
                                    </li>
			  						<li>
                                    <a href="#"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                    </a>

                                    <form id="logout-form" action="{{url('/team/logout')}}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    </form>
                                    </li>
                                </ul>
                            </li>
                        
                         </ul>
       
    </div></div>
   
</div>

 <div class="subnavbar">
        <div class="subnavbar-inner">
            <div class="container">
                <ul class="mainnav">
                    <li><a href="{{url('/team/login')}}"><i class="icon-dashboard"></i><span>Tablero</span> </a>
                    </li>
                    <li>
                    <a href="#"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="icon-dashboard"></i><span>Cerrar sesión</span> </a>
                   
                    </li>
               </ul>
            </div></div>
        
    </div>

@yield('content')

<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row"> 
        <div class="span12"> &copy; 2017 <a href="#">{{strtoupper($setting->ftext)}}</a> </div>
         
      </div>
       
    </div></div>
   
</div>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
  $(function() {
               $(".datepickert").datepicker({ dateFormat: "dd-mm-yy" }).val()
       });
</script>
</body>

</html>

