<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\Comment;
use App\User;

class CommentController extends Controller
{   
    /**
     * Returning comments of a given post
     */
    public function index(Post $post) {
        return response()->json($post->comments()->with('user')->latest()->get());   
    }
    
    /**
     * Storing (saving) a comment
     */
    public function store(Post $post, Request $request) {

        $comment = $post->comments()->create([
            'sub' => $request->sub,
            'content' => $request->content,
            'post_id' => $post->id
        ]);

        $comment = Comment::whereId($comment->id)->with('user')->first();

        return $comment->toJson();
    }

    /**
     * Getter for a certain comment
     */
    public function retrieve($postId, $commentId) {
        $comment = Comment::find($commentId);
        
        return $comment;
    }

    /**
     * Updating (changing) a comment
     */
    public function update($postId, $commentId, Request $request) {
        $comment = Comment::find($commentId);
        $comment->content = $request->content;

        $comment->save();
    }

    /**
     * Deleting a given comment
     */
    public function remove($postId, $commentId) {
        $comment = Comment::find($commentId);

        $comment->delete();
    }
}
