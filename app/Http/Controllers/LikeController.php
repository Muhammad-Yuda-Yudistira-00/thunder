<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likePost($post_id)
    {
        $post = Post::findOrFail($post_id);
        $post->like();

        return back();
    }

    public function unlikePost($post_id)
    {
        $post = Post::findOrFail($post_id);
        $post->unlike();

        return back();
    }

    public function likeComment($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->like();

        return back();
    }

    public function unlikeComment($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->unlike();

        return back();
    }
}
