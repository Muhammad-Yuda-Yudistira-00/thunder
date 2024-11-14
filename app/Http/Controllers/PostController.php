<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Room;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function store(Request $request, $slug)
    {
        try {
            $request->merge([
                'body' => $request->input('post-trixFields.content')
            ]);
            $validatedData = $request->validate([
                'body' => 'required|string|min:5',
            ]);
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['room_id'] = Room::where('slug', $slug)->first()->id;
            Post::create($validatedData);
            return back()->with('success', 'Your post has been created!');
        } catch(ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->with('failed', 'Your post failed to create!');
        }
    }
}
