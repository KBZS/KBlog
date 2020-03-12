<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\Auth0IndexController;
use App\User;
use App\Post;

class PostsController extends Controller
{
    /**
     * Getter of all posts for a home page (feed)
     */
    public function getPosts() {

        $posts = \App\Post::latest()->get();
        // $users = \App\User::all();
        Auth0IndexController::loginStore();
        return view('home', compact('posts'));
    }

    /**
     * Getter of specific post (when inspecting a post on a click)
     */
    public function getPost($id) {

        // $users = \App\User::all();
        $post = \App\Post::find($id);

        return view('post', compact('post'));
    }

    /**
     * Accessing post edit page
     */
    public function editPost($id) {

        // $users = \App\User::all();
        $post = \App\Post::find($id);

        return view('edit_post', compact('post'));
    }

    /**
     * Updating a post
     */
    public function update($id) {

        $this->validate(request(), [

            'title' => 'required|max:50',
            'content' => 'required|max:5000',
            'image' => 'image'
        ]);

        $post = Post::find($id);
        $post->sub = request('auth0usersub');
        $post->heading = request('title');
        $post->content = request('content');
        if(request('nsfw') == "on") {
            $post->nsfw = true;
        } else {
            $post->nsfw = false;
        }
        if(!empty(request()->file('image'))) {
            $post->image = request()->file('image')->store('public/images');
        } 

        $post->save();
        return redirect('/');
    }

    /**
     * Deleting a given post
     */
    public function remove($id) {
        $post = Post::find($id);
        $post->delete();

        return redirect('/');
    }

}
