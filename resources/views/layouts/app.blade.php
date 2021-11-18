<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">
    

    <title>ThunderVIN Chile - Campa&ntilde;as de Servicio</title>
    <link rel="shortcut icon" href="https://www.campanas-servicio.co/frontend/img/favicon.png">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/skins/_all-skins.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="../../public/css/app.css">
    
    @if (Auth::user()->hasRole('wolks')) 
    <link rel="stylesheet" href="{{ asset('frontend/css/specialadmins.css') }}">
    @endif
    @if (Auth::user()->hasRole('man')) 
    <link rel="stylesheet" href="{{ asset('frontend/css/specialadmins.css') }}">
    @endif
    
    
    @yield('css')
    
    <!--HACKS FOR IE-->
      <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script type="text/javascript">
   document.createElement("nav");
   document.createElement("header");
   document.createElement("footer");
   document.createElement("section");
   document.createElement("article");
   document.createElement("aside");
   document.createElement("hgroup");
</script>
<![endif]-->
</head>

<body class="skin-blue sidebar-mini">
    
    
    
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="{!! url('/admin') !!}" class="logo">
            	<img src="{{ asset('frontend/img/logo_thundervin_white.png') }}"  class="logo-image" alt="ThunderVIN - VIN Manager System"/>
                <!--b>ThunderVin</b-->
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Menu</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notifications-menu">
                            <a id="notificaciones-btn" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                              <i class="fa fa-bell-o"></i>
                              <span class="label label-warning">{{ $notificaciones_count }}</span>
                            </a>
                            <ul class="dropdown-menu">
                              <li class="header">Tienes {{$notificaciones_count}} notificaciones</li>
                              <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @if($notifications)
                                        @foreach($notifications as $notification)
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-users text-aqua"></i> {{ $notification['descripcion'] }} {{ $notification['created'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                              </li>
                              <li class="footer"><a href="{!! route('notificaciones.index') !!}">Ver todas las alertas ></a></li>
                            </ul>
                        </li>
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('frontend/img/usuario_thundervin_150x150.jpg') }}"
                                     class="user-image" alt="Imagen de Usuario"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('frontend/img/usuario_thundervin_150x150.jpg') }}"
                                         class="img-circle" alt="Imagen de Usuario"/>
                                    <p>
                                        {!! Auth::user()->name !!}
                                        <small>Usuario desde {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-default btn-flat">Editar Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/admin/logout') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>
                                        <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
      

            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
          
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
            <div class="row back-button"><a id="regresar-link" href="javascript:history.back();"><i class="fa fa-arrow-left"></i> Regresar</a></div>
        </div>
 <!--Alert Browser-->
         <div onclick="myClose()" id="browser-alert"><span>X</span><b>Nota importante:</b> Para una mejor experiencia de usuario en toda la plataforma, por favor utilice otro navegador diferente a Internet Explorer en versiones inferiores a IE 11  (Microsoft Edge). Pruebas realizadas han comprobado que pueden ocurrir fallos en la gesti&oacute;n de informaci&oacute;n, uso de calendarios y carga de archivos, por lo que recomendamos utilizar navegadores como Google Chrome o Mozilla Firefox. Gracias.</p></div>
         <script>
function myClose() {
    var x = document.getElementById("browser-alert");
    if (x.style.display === "none") {
        x.style.display = "none";
    } else {
        x.style.display = "none";
    }
}
</script>

<!-->
        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
	Copyright &copy; 2020 Todos los derechos reservados.<strong> Porsche Chile SpA</strong>
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Menu Toggle</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/') !!}">
                   ThunderVIN
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/') !!}">Inicio</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/admin/login') !!}">Ingreso</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif
    


    <!-- jQuery 2.1.4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/js/app.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function(e) {
        $('#notificaciones-btn').click(function(e) {
            $.ajax({
                url: '{{ route("cambiar-estado") }}',
                type: 'get',
            });
        });
    });
    </script>
    @yield('scripts')
</body>
</html>
