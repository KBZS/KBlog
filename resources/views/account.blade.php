@extends('layouts.app')


@section('content')

    <head>
    </head>

    <body>

        <header class="masthead" style="background-image: url( {{ Storage::url('images/cactus.jpg') }} )">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                            <h1>{{ $user->name }}</h1>
                            <br>
                            <span class="subheading">

                                Account created

                                <a>{{ $user->created_at->diffForHumans() }}</a>
                                <br><br>

                                Email: 

                                <a>{{ $user->email }}</a>
                                <br><br>

                                @if ($user->posts == 1)
                                    <a>{{ $user->posts }}</a>
                                    post was created 
                                @else
                                    <a>{{ $user->posts }}</a>
                                    posts were created 
                                @endif
                                <br><br>

                                <img class="rounded-circle" src="{{ $user->picture }}" width="200" height="200">
                                <br><br>
                                
                                <a class="nav-item">
                                    <a class="nav-link" href={{ route('logout') }}>Logout</a>
                                </a>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>


    </body>

@endsection