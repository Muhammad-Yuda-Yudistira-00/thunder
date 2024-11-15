<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        $users = User::all();

        foreach (range(1, 500) as $i) {
            Comment::create([
                'post_id' => $posts->random()->id, // Assign a random post
                'user_id' => $users->random()->id, // Assign a random user
                'parent_comment_id' => rand(0, 1) ? Comment::inRandomOrder()->value('id') : null, // Random parent or null
                'comment_text' => fake()->sentence(rand(5, 15)),
            ]);
        }
    }
}
