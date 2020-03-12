@extends('layouts.app')


@section('content')
 
    <body class="page">        
        
        <div class="container">
            <section class="create">
                <div class="offset-sm-5 col-sm-7">
                    <b class="head">
                        Edit a post
                    </b>
                </div>
                <form method="post" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
                    {{method_field('PATCH')}}
                    @csrf

                    <div class="form-group row">
                        <label for="titleid" >
                            <b>Post Title</b>
                        </label>
                        <div class="col-sm-9">
                            <textarea name="title" cols="85" rows="1"  id="titleid" required> {{$post->heading}} </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="textid" >
                            <b>Post Text</b>
                        </label>
                        <div class="col-sm-9">
                            <textarea name="content" cols="85" rows="5" id="contentid" required> {{$post->content}} </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nsfwcheckboxid" >
                            <b>NSFW (not safe for work)</b>
                        </label>
                        <div class="col-sm-9">
                            <input class="checkbox" name="nsfw" type="checkbox" ></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="imageid" >
                            <b>Image</b>
                        </label>
                        <div class="col-sm-9">
                            <input name="image" type="file" id="postimageid" class="btn btn-add">
                            <span class="custom-file-control"></span>
                        </div>
                    </div>

                    <input hidden class="form-control" type="text" value="{{ Auth::id() }}" name = "auth0usersub">

                    <div class="form-group row" style="text-align:center">
                        <div class="offset-sm-3 col-sm-6">
                            <button type="submit" class="btn btn-secondary" id="submit" >Save</button>
                        </div>
                    </div>
                </form>

                @if (count($errors))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </section>
        </div>

    </body>
 
@endsection
