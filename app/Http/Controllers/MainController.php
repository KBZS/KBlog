<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;



class MainController extends Controller
{
    /**
     * Accessing post creation page
     */
    public function create() {
        return view('create');
    }

    /**
     * Accessing account information for an account page
     */
    public function account() {

        $user = User::whereSub(\Auth::id())->first();
        return view('account', compact('user'));
    }
    
    /**
     * Storing (saving) new post
     */
    public function store()
    {
        $this->validate(request(), [

            'title' => 'required|max:50',
            'content' => 'required|max:5000',
            'image' => 'image'
        ]);

        $post = new Post;
        $post->sub = \Auth::id();
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

        $user = User::whereSub(\Auth::id())->first();
        $user->posts = $user->posts + 1;
        $user->save();

        return redirect('/');
    }
}
