@extends('layouts.app')


@section('content')

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <head>
    </head>

    <body>
        @csrf
            
        {{-- Page Header --}}

        <header class="masthead" style="background-image: url( {{ Storage::url($post->image) }} )">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                            <h1>{{ $post->heading }}</h1>
                            <br>
                            <span class="subheading">

                                Posted by

                                <a>{{ $post->user->name }}</a>
                                <a>{{ $post->created_at->diffForHumans() }}</a>
                                <br><br>
                                <img class="rounded-circle" src="{{ $post->user->picture }}" width="100" height="100">

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        {{-- Post contents --}}

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                
                    <div class="post-preview">

                        <h4 class="center">
                            Post content
                        </h4>
                        <br>

                        <a>{{ $post->content }}</a>
                        <br><br>
                        <img class="card-img-top" class="img-thumbnail" src="{{ Storage::url($post->image)  }}" alt="">
                        
                    </div>
                    <br>
                </div>
            </div>

        </div>

        

        {{-- Comments --}}

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">

                    <br>

                    <h4 class="center">
                        Comments
                    </h4>
                    <br>

                    <div v-if="comments.length === 0">
                        
                        <div class="text-center">

                            <blockquote class="blockquote">
                                No comments yet
                            </blockquote>

                        </div>

                    </div>
                    
                    <div v-if="comments.length > 0">

                        <ul class="list-group">
                            <div v-for="comment in comments">
                                <li class="list-group-item">

                                    <h6>
                                        @{{ comment.content }}
                                    </h6>

                                    <a>
                                        by
                                        @{{ comment.user.name }}
                                        at 
                                        @{{ comment.created_at }}
                                    </a>
                                
                                </li>
                                <div class="text-center">
                                    <div v-if="allowedEdit(comment)">
                                        
                                        <button class="btn btn-comment" @click.prevent="curComment = getCommentId(comment); state = 'edit'"> Change </button>
                                        <button class="btn btn-comment" @click.prevent="removeComment(comment)"> Remove </button>
                                        
                                        <div v-if="curComment === comment.id">
                                            <div v-show="state === 'edit'">
                                                <textarea v-model="editBox" cols="65" rows="2" class="border" placeholder="Change comment here"></textarea>
                                                <div>
                                                    <button class="btn btn-comment" @click.prevent="cancelEdit"> Close </button>
                                                    <button class="btn btn-comment" @click.prevent="saveChange(comment)"> Save </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </ul>

                    </div>
                    
                    <br>


                    @if (Auth::id() != null) 

                        <div class="form-group row">
                            <div class="col-sm-9">
                                <textarea name="content" cols="65" rows="3" id="contentid" v-model="commentText" placeholder="Write a comment here. Max characters: 1000." required></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row" style="text-align:center">
                            <div class="offset-sm-3 col-sm-6">
                                <button class="btn btn-primary" @click.prevent="postComment">Post a comment</button>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
        <br>
    
    </body>


    {{-- Vue.js script for comments --}}

    <script>

        const app = new Vue({

            el: '#app',

            data: {
                comments: {},
                commentText: '',
                state: 'default',
                editBox: '',
                curComment: '',
                post: {!! $post->toJson() !!},
                user: {!! Auth::check() ? Auth::user() : 'null' !!} 

            },

            mounted() {
                Vue.config.devtools = true;
                this.getComments();
            },

            methods: {

                getComments() {
                    axios.get('/api/posts/' + this.post.id + '/comments')
                        .then((response) => {
                            this.comments = response.data;
                        })
                        .catch(function (error) {
                            console.log(error.response);
                        }
                    );
                },

                allowedEdit(c) {
                    try {
                        return this.user.sub === c.sub;
                    } catch (error) {
                        return false;
                    }
                    // if (this.user.sub === null) {
                    //     this.user.sub = "";
                    // }
                    // return this.user.sub === c.sub;
                },

                saveChange(c) {
                    this.state = 'default';
                    axios.patch('/api/posts/' + this.post.id + '/comments/' + c.id, {
                        content: this.editBox
                    })
                        .then((response) => {
                            this.getComments();
                        })
                        .catch(function (error) {
                            console.log(error.response);
                        })

                },

                cancelEdit() {
                    this.state = 'default';
                    this.editBox = '';
                },

                getCommentId(c) {
                    axios.get('/api/posts/' + this.post.id + '/comments/' + c.id)
                        .then((response) => {
                            this.curComment = c.id;
                        })
                        .catch(function (error) {
                            console.log(error.response);
                        }
                    );
                },

                removeComment(c) {
                    axios.delete('/api/posts/' + this.post.id + '/comments/' + c.id)
                        .then(response => {
                            this.getComments();
                        })
                        .catch(function (error) {
                            console.log(error.response);
                        })
                },

                postComment() {
                    
                    axios.post('/api/posts/' + this.post.id + '/comment', {
                        sub: this.user.sub,
                        content: this.commentText
                    })
                        .then((response) => {
                            this.comments.unshift(response.data);
                            this.commentText = '';
                            this.getComments();
                        })
                        .catch(function (error) {
                            console.log(error.response);
                        })
                }
            }

        })

    </script>

@endsection

