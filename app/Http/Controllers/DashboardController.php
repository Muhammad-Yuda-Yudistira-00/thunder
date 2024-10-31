<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Post;

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
        $posts = Post::where('category', $active)->latest()->get();
        // dd($posts);
        return view('dashboard', ['active' => $active, 'rooms' => $rooms, 'posts' => $posts]);
    }
}
