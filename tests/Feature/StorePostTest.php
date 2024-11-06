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

    protected $slug, $roomId, $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Room::factory(4)->create();
        $this->slug = Room::inRandomOrder()->value('slug');
        $this->roomId = Room::inRandomOrder()->value('id');
    }

    #[Test]
    public function it_creates_a_posting_with_valid_data()
    {
        $this->actingAs($this->user);

        $data = [
            'body' => 'This is message valid',
            'room_id' => $this->roomId,
            'user_id' => $this->user->id,
        ];

        $this->assertNotNull($this->slug, 'Slug is null');
        $this->assertNotNull($this->roomId, 'RoomId is null');
        $response = $this->post(route('post.store', ['slug' => $this->slug]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Your post has been created!');

        $this->assertDatabaseHas('posts', [
            'body' => 'This is message valid',
            'room_id' => $this->roomId,
            'user_id' => $this->user->id,
        ]);
    }

    #[Test]
    public function it_creates_a_posting_with_invalid_data()
    {
        $this->actingAs($this->user);

        $data = [
            'body' => 'Hey',
            'room_id' => $this->roomId,
            'user_id' => $this->user->id
        ];

        $this->assertNotNull($this->slug);
        $this->assertNotNull($this->roomId);
        $response = $this->post(route('post.store', ['slug' => $this->slug]), $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('body');

        $this->assertDatabaseMissing('posts', [
            'body' => 'Hey',
            'room_id' => $this->roomId,
            'user_id' => $this->user->id
        ]);
    }

    #[Test]
    public function it_fails_when_user_is_not_authenticated()
    {
        $data = [
            'body' => 'Tidak login dahulu',
            'room_id' => $this->roomId,
            'user_id' => null
        ];

        $this->assertNotNull($this->slug);
        $this->assertNotNull($this->roomId);

        $response = $this->post(route('post.store', ['slug' => $this->slug]), $data);
        $response->assertRedirect(route('login'));

        $this->assertDatabaseMissing('posts', [
            'body' => 'Tidak login dahulu',
            'room_id' => $this->roomId,
            'user_id' => null
        ]);
    }
}
