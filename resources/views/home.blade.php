@extends('layouts.app')


@section('content')

    <head>
    </head>

    <body>
        @csrf
            
        <!-- Page Header -->

        <header class="masthead" style="background-image: url( {{ Storage::url('images/cactus.jpg') }} )">
            <div class="overlay"></div>
            <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>KBlog</h1>
                    <span class="subheading">Discussions about cactuses</span>
                </div>
                </div>
            </div>
            </div>
        </header>
        

        <!-- Main Content -->

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    @foreach ($posts as $post)

                        <div class="post-preview">
                            <a href="/posts/{{ $post->id }}">
                                <h2 class="post-title">{{ $post->heading }}
                                    @if ($post->nsfw == true) 
                                        <b class="atten"> NSFW!</b>
                                    @endif
                                </h2>
                                <h3 class="post-subtitle">{{ $post->content }}</h3>
                                @if ($post->nsfw == true) 
                                    <img class="card-img-top" class="rounded" style="filter: blur(40px)" src="{{ Storage::url($post->image)  }}" alt="">
                                @else
                                    <img class="card-img-top" class="rounded" src="{{ Storage::url($post->image)  }}" alt="">
                                @endif
                            </a>
                            <p class="post-meta">
                                Posted by

                                <a>{{ $post->user->name }}</a>
                                <a>{{ $post->created_at->diffForHumans() }}</a>
                                
                                @if ($post->sub == Auth::id())

                                    <form method= "post" action="/posts/{{$post->id}}">
                                        {{method_field("DELETE")}}
                                        @csrf
                                        <button class="btn btn-comment" type="submit" id="submit" >Delete</button>
                                        <a type="button" class="btn btn-comment" href="/edit/{{ $post->id }}" id="edit" >Edit</a>
                                    </form>
                                    
                                @endif
                            </p>
                        </div>

                        <hr>

                    @endforeach
                </div>
            </div>
        </div>
    
    </body>

@endsection