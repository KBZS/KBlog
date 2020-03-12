<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> KBlog </title>

    <!-- Bootstrap-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        
    <!-- Custom fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    
    <!-- Scripts -->
    <link href="resources/js/kblog.min.js" rel="script">
    {{-- <link href="resources/js/app.js" rel="script"> --}}

    <!-- Custom Styles -->
    <link href="http://kblog.test/css/kblog.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">

         <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">

                <a class="navbar-brand" href="/">KBlog</a>
                
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    
                    <ul class="navbar-nav ml-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li> --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login/Signup') }}</a>
                            </li>
                        @else

                            @if ( Request::url() != "http://kblog.test/create" ) 
                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('create') }}>Create new post</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href={{ route('logout') }}>Logout</a>
                            </li>

                            @if (Auth::user()->name == Auth::user()->email)
                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('account') }}>{{ Auth::user()->nickname }}</a>
                                </li>
                            @endif

                            @if (Auth::user()->name != Auth::user()->email)
                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('account') }}>{{ Auth::user()->name }}</a>
                                </li>
                            @endif
                            
                        @endguest
                    </ul>
                    @guest
                    @else
                        <a class="nav-link" href={{ route('account') }}>
                            <img class="rounded-circle" src="{{ Auth::user()->picture }}" width="43" height="43" >
                        </a>
                    @endguest
                </div>
            </div>
        </nav>
        

        <main class="">
            @yield('content')
        </main>
    </div>


  <!-- Footer -->
    <footer class="masthead" style="background-image: url( {{ Storage::url('images/cactusfooter.jpg') }} )">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                    <a href="https://www.instagram.com/oji_sofu/">
                        <span class="fa-stack fa-lg">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    </li>
                    <li class="list-inline-item">
                    <a href="https://www.facebook.com/kirill.beznosov">
                        <span class="fa-stack fa-lg">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    </li>
                    <li class="list-inline-item">
                    <a href="https://github.com/KBZZSS">
                        <span class="fa-stack fa-lg">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    </li>
                </ul>
                <p class="copyright text">Kirill Beznosov 2019-2020</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
