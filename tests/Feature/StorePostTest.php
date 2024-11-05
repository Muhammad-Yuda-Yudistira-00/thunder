<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Room;
use PHPUnit\Framework\Attributes\Test;

// PR: it_create_a_posting_with_failed_insert_to_database

class StorePostTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_posting_with_valid_data()
    {
        $user = User::factory()->create();
        $slug = Room::factory()->create();
        $this->actingAs($user);

        $slug = Room::inRandomOrder()->value('slug');
        $roomId = Room::inRandomOrder()->value('id');


        $data = [
            'body' => 'This is message valid',
            'room_id' => $roomId,
            'user_id' => $user->id,
        ];

        $this->assertNotNull($slug, 'Slug is null');
        $this->assertNotNull($roomId, 'RoomId is null');
        $response = $this->post(route('post.store', ['slug' => $slug]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Your post has been created!');

        $this->assertDatabaseHas('posts', $data);
    }

    #[Test]
    public function it_creates_a_posting_with_invalid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'body' => 'Hey',
        ];

        $response = $this->post(route('post.store'), $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('body');
        $response->assertSessionHasErrors('room_id');

        $this->assertDatabaseMissing('posts', $data);
    }

    #[Test]
    public function it_fails_when_user_is_not_authenticated()
    {
        $data = [
            'message' => 'Tidak login dahulu',
            'category' => 'anime',
        ];

        $response = $this->post(route('post.store'), $data);
        $response->assertRedirect(route('login'));
    }
}
