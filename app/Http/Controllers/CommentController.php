<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($post_id);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'comment_text' => $request->comment_text,
            'parent_comment_id' => null,
        ]);

        return back();
    }

    public function reply(Request $request, $comment_id)
    {
        $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        $parentComment = Comment::findOrFail($comment_id);

        Comment::create([
            'post_id' => $parentComment->post_id,
            'user_id' => Auth::id(),
            'comment_text' => $request->comment_text,
            'parent_comment_id' => $parentComment->id,
        ]);

        return back();
    }

    public function destroy($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);

        if ($comment->user_id === Auth::id() || Auth::user()->is_admin) {
            $comment->delete();
        }

        return back();
    }
}
