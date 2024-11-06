<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'body' => 'required|string|min:5',
                'room_id' => 'required|integer'
            ]);
            $validatedData['user_id'] = auth()->user()->id;

            Post::create($validatedData);
            return back()->with('success', 'Your post has been created!');
        } catch(ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->with('failed', 'Your post failed to create!');
        }
    }
}
