<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/img/icon2.png">
    <link rel="manifest" href="img/favicon/manifest.json">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Style -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/loading-bar.css">
    <link rel="stylesheet" href="/css/prism.css">

    <!-- Your Own Style -->
    <link rel="stylesheet" href="/css/default.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/auth.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    @yield('your_css')


   <!--  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
      <!-- Loading -->
    <div class="content-loading">
        <div data-type="fill" class="loading-bar ldBar"></div>
    </div>
    <!-- Partials Navbar -->
      <!-- Navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Left Navbar Menu -->
            <div class="navbar-header">
                <a href="#" class="navbar-brand visible-xs trigger-sidebar"><i class="fa fa-bars"></i></a>
                <a href="{{ route('home') }}" class="navbar-brand"><img src="/img/logo.png" alt=""></a>
                <a href="#" class="navbar-brand visible-xs trigger-navbar"><i class="fa fa-ellipsis-v"></i></a>
            </div>

            <!-- Middle Navbar Menu -->
            <ul class="navbar-nav nav">
                <li><a href="{{ route('dashboard') }}" class="item"><i class="fa fa-home"></i> Beranda</a></li>
    <!--             <li><a href="messages.html" class="item"><i class="fa fa-inbox"></i> Messages</a></li> -->
    <!--             <li><a href="https://github.com/muhibbudins/wonderful" class="item"><i class="fa fa-github"></i> Github</a></li> -->
            </ul>
              @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login / Register</a></li>
                        @else
                         <ul class="navbar-nav navbar-right nav">
                             <li class="dropdown"><a class="dropdown-toggle profile item-scroll" data-toggle="dropdown" role="button" aria-expanded="false" class="item btn btn-info item">
                                  @if(Auth::user()->img_url != null)
                                 <img src="{{Storage::url(Auth::user()->img_url)}}" class="rounded-small"> 
                                 @else  
                                 <img src="/img/img_ss/malo.png" class="rounded-small"> 
                                 @endif

                                 
                             </a>

                            <ul class="dropdown-menu" role="menu">
                                    <li>
                                            <p>Profil</p>
                                            <p>{{ Auth::user()->nama_depan . " " .Auth::user()->nama_belakang}}</p>
                                        </li>
                                    <li>
                                            @if (Auth::user()->isAdmin())
                                            <a class="item" href="{{route('dashboard')}}">
                                                Dashboard
                                            </a>
                                            <a class="item" href="{{route('single-user' , ["user" => Auth::user()->str_slug])}}">
                                                Pengaturan
                                            </a>
                                            @elseif(Auth::user()->isSuperAdmin())
                                             <a class="item" href="{{route('superadmin')}}">
                                                System
                                            </a>
                                            <a class="item" href="{{route('single-user' , ["user" => Auth::user()->str_slug])}}">
                                                Pengaturan
                                            </a>
                                            @elseif(Auth::user()->isUser())
                                            <a class="item" href="{{route('single-user' , ["user" => Auth::user()->str_slug])}}">
                                                Pengaturan
                                            </a>
                                            @endif
                                        </li>
                                    <li>                                                                                                     
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="item">
                                            Keluar
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>

                            </li>
                        </ul>
                        @endif

            <!-- Right Navbar Menu -->
           
        </div>
    </div>

    <!-- Navbar Responsive -->
    <div class="navbar-responsive visible-xs"></div>

        <!-- Partials Sidebar -->
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav nav-pills">
            <li><a href="#" class="item item-side active" data-target="first-menu"><i class="ion-university"></i></a></li>
            <li><a href="#" class="item item-side" data-target="second-menu"><i class="ion-android-person"></i></a></li>
            <li><a href="#" class="item item-side" data-target="third-menu"><i class="ion-cube"></i></a></li>
        </ul>
    </div>

    <!-- Secondary Sidebar -->
    <div class="sidebar-menu">
        <ul id="first-menu" class="nav nav-pills nav-stacked active">
            <li><a href="#" class="item item-head">Dashboard</a></li>
             <li><a href="{{ route('scholarshipList') }}" class="item item-side">Daftar Beasiswa</a></li>
             <li><a href="{{ route('scholarshipCreate') }}" class="item item-side">Tambah Beasiswa</a></li>
             @if(Auth::user()->isSuperAdmin())
              <li><a href="{{ route('facilitatorList') }}" class="item item-side">Daftar Fasilitator</a></li>
              <li><a href="{{ route('emailList') }}" class="item item-side">Daftar Permintaan Email</a></li>
             @endif
        </ul>

        <ul id="second-menu" class="nav nav-pills nav-stacked">
            <li><a href="#" class="item item-head">Pengaturan User</a></li>
            <li><a href="{{ route('profile') }}" class="item item-side">Profil</a></li>
        </ul>
    </div>

        @yield('content')
        <section id="partial-component"></section>
    </div>

    <!-- Vendor Script -->
    <script type="text/javascript" src="/js/jquery.min.js"></script>

    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/loading-bar.js"></script>
    <script type="text/javascript" src="/js/nicescroll.min.js"></script>
    <script type="text/javascript" src="/js/prism.js"></script>
    
    <!-- Component Script -->

    <!-- Your Own Script -->
    <script type="text/javascript" src="/js/load.js"></script>
    <script type="text/javascript" src="/js/default.js"></script>
    <script>
    	$('body, .content').niceScroll({
				cursorwidth: '2px'
            });
            </script>
    @yield('your_js')
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
@include('sweet::alert')
</body>
</html>
