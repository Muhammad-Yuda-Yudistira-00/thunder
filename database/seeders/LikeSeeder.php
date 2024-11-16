<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        Post::all()->each(function ($post) use ($users) {
            $users->random(rand(1, $users->count()))->each(function ($user) use ($post) {
                $post->like($user->id);
            });
        });

        Comment::all()->each(function ($comment) use ($users) {
            $users->random(rand(1, $users->count()))->each(function ($user) use ($comment) {
                $comment->like($user->id);
            });
        });
    }
}
