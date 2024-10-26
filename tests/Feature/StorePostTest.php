<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Posting;
use PHPUnit\Framework\Attributes\Test;

// PR: it_create_a_posting_with_failed_insert_to_database

class StorePostTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_posting_with_valid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'message' => 'This is message valid',
            'category' => 'hollywood',
            'user_id' => $user->id,
        ];
        $response = $this->post(route('post.store'), $data);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Your post has been created!');

        $this->assertDatabaseHas('postings', $data);
    }

    #[Test]
    public function it_creates_a_posting_with_invalid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'message' => 'Hey',
        ];

        $response = $this->post(route('post.store'), $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('message');
        $response->assertSessionHasErrors('category');

        $this->assertDatabaseMissing('postings', $data);
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
