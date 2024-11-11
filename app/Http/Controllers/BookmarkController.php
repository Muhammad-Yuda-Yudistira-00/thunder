<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function bookmarkPost($post_id)
    {
        $user_id = Auth::id();

        if (!Bookmark::where('user_id', $user_id)->where('post_id', $post_id)->exists()) {
            Bookmark::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
            ]);
        }

        return back();
    }

    public function removeBookmarkPost($post_id)
    {
        $user_id = Auth::id();

        Bookmark::where('user_id', $user_id)->where('post_id', $post_id)->delete();

        return back();
    }
}
