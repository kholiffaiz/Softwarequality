<?php

namespace Tests\Feature;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_guest_user_cannot_see_tweet_page()
    {
        $response = $this->get('/tweet');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_see_tweet_page()
    {
        // arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/tweet');

        $this->assertAuthenticatedAs($user);
        $response->assertSeeText('Tweet');
    }

    /** @test */
    public function an_authenticated_user_can_post_a_tweet()
    {
        // arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/tweet', [
            'content' => $tweet = 'Test tweet pertama',
        ]);

        $this->assertDatabaseHas('tweets', [
           'user_id' => $user->id,
           'content' => $tweet,
        ]);
    }

    /** @test */
    public function a_tweet_owner_can_edit_their_tweet()
    {
        $user = User::factory()->create();
        $tweet = Tweet::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);
        $response = $this->get('/tweet/' . $tweet->id . '/edit');

        $response->assertSuccessful();
        $response->assertSeeText($tweet->content);
    }
}
