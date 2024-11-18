<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Post;
use App\Models\Bookmark;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $active = Room::get()->pluck('slug')->first();
        return redirect()->route('dashboard.show', ['slug' => $active]);
    }

    public function show(string $slug)
    {
        $rooms = Room::get();
        $active = Room::where('slug', $slug)->pluck('slug')->first();
        $roomId = Room::where('slug', $slug)->pluck('id')->first();
        $posts = Post::with(['comments', 'comments.user'])->where('room_id', $roomId)->latest()->paginate(10);

        $bookmarks = Bookmark::with(['user', 'post'])->latest()->paginate(10);

        dd($bookmarks[0]->post);

        return view('dashboard', ['active' => $active, 'rooms' => $rooms, 'posts' => $posts, 'roomId' => $roomId]);
    }
}
